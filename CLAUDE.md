# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## What this is

**Franapp** — a point-of-sale / multi-warehouse inventory app (products, purchases, sales, returns, clients, stock per warehouse, PDF tickets, barcodes). Laravel 12 backend + Vue 3 SPA-ish islands mounted on Blade pages. Served locally by Laravel Herd at `http://franapp.test` (MySQL database `franapp`).

**UI text, validation messages, and code comments are in Spanish.** Match that when adding user-facing strings.

## Commands

```bash
composer install
npm ci                      # Node 22 (.nvmrc)

npm run dev                 # Vite dev server (HMR); Herd serves PHP
npm run build               # production build -> public/build (committed to git)

php artisan migrate
php artisan db:seed         # UserSeeder + PermissionSeeder
php artisan tinker

php artisan test                                  # or vendor/bin/phpunit
php artisan test --filter=SomeTest                # single test
php artisan test tests/Feature/SomeTest.php
```

Built assets under `public/build/` are tracked in git — run `npm run build` and commit them when shipping frontend changes.

**Tests hit the real MySQL database.** `phpunit.xml` has the sqlite `:memory:` lines commented out, so `APP_ENV=testing` still uses the `.env` connection. Only `tests/Unit/ExampleTest.php` and `tests/Feature/ExampleTest.php` exist; adding a test that uses `RefreshDatabase` will wipe the dev database unless you uncomment the sqlite server vars first.

## Laravel skeleton: pre-11 layout on Laravel 12

The framework was upgraded to 12 but the **old application skeleton was kept**. Do not apply Laravel 11+ conventions here:

- `bootstrap/app.php` is the classic container bootstrap — there is no `bootstrap/providers.php` and no `->withMiddleware()/->withRouting()` builder.
- Middleware stack and route-middleware **aliases** live in `app/Http/Kernel.php` (e.g. `context.inventory`).
- Providers are listed in `config/app.php` (`providers`, plus the `CurrentUser` alias); policies in `app/Providers/AuthServiceProvider.php`; event→listener map in `app/Providers/EventServiceProvider.php`.
- Facade aliases/bindings are hand-rolled: `App\Facades\InventoryContext` → `'inventory.context'` and `CurrentUser` → `'CurrentUser'`, both bound in `AppServiceProvider::register()`.

## Architecture

### Inventory context (multi-warehouse)

Every warehouse is an `Inventory`. The **active warehouse is session state** (`session('inventory_id')`), not a request parameter:

- `EnsureInventoryContext` middleware (alias `context.inventory`, applied to nearly every web route) resolves it from the session → the user's `inventory_id` → the only inventory if there is exactly one → otherwise redirects to `select-inventory`.
- Read it anywhere via the `InventoryContext` facade (`InventoryContext::id()`), backed by `App\Services\InventoryContext`.
- Stock lives on the `inventory_product` pivot (`stock` column). `Inventory::updateStock()`, `Inventory::hasStock()`, and the `HasStock` trait (`existsProductInStock()`, which throws a `ValidationException` in Spanish) are the accessors.

A new web route that touches products/stock almost always needs `->middleware('auth', 'context.inventory')`.

### Transactions (sales & purchases) are session-scoped carts

A `Sale`/`Purchase` row is created *empty* the moment the first product is added, and its id is parked in the session (`sale_id`, `purchase_id`):

- `Sale::findOrCreateTheTransaction()` scope / `Purchase::findOrCreateThePurchase()` create-or-fetch the open transaction.
- Line items are pivot rows (`product_sale` with `qty`,`sale_price`; `product_purchase` with `qty`,`purchase_price`). `ProductInSaleController` / `ProductInPurchaseController` add/update/remove them.
- Sale line prices come from the client's `assigned_price` enum, which names the price *column* to use (`retail_price`/`wholesale_price`/`distributor_price`); with no client attached it falls back to `retail_price` — see `JsonApiBuilder::transactions()`.
- `status` moves `pending` → `completed` (or `cancelled`). Completing (`SaleController@store`) validates with `App\Rules\CanCompleteSale`, computes `total` server-side from the pivot, records a `Payment` (polymorphic `payable`), and clears the session key.

### Stock is moved by an event, not by the controllers

`TransactionComplete::dispatch($transaction, $factor)` → `UpdateInventory` listener walks the transaction's pivot rows and applies `stock + factor * qty` on `inventory_product`, throwing a Spanish `ValidationException` if the result would go negative.

- `$factor = -1` when a sale is completed, `+1` when it is cancelled or when a purchase is received.
- Always dispatch inside `DB::transaction()` together with the status change — the listener runs synchronously (`QUEUE_CONNECTION=sync`) so its exception rolls the whole thing back. Follow the pattern in `SaleController@store`/`@destroy`.

### JSON:API-ish query layer

`JsonApiProvider` does `Builder::mixin(new JsonApiBuilder)`, adding macros available on **every** Eloquent query builder:

- `applyFilters()` — maps `?filter[x]=v` onto a **named scope** `scopeX`, aborting 400 if no such scope exists. So a new filter = a new scope, nothing else.
- `include()` — `?include=relation,relation` → eager loads, aborting 500 if the relation method is missing.
- `transactions($product)`, `getTransaction()` — the cart helpers above.

Report/date filter scopes (`today`, `week`, `currentMonth`, `betweenDates`, `status`, `byWarehouses`, `user`, …) come from the `ReportBy` trait on `Sale`/`Purchase`. `ReportResponse` is the shared Responsable that runs `include()->applyFilters()->paginate(20)` and appends a `total` on page 1.

Controllers branch on `request()->wantsJson()`: HTML view for the page load, JSON for the Vue components' axios calls. Same route, two shapes.

### Authorization

`spatie/laravel-permission` with a permission-string-per-action model:

- The canonical permission list is `database/seeders/PermissionSeeder.php` (`'view sales'`, `'edit stock'`, …). New features need their strings added there, and re-seeding.
- Policies in `app/Policies` just call `hasPermissionTo(...)`; the `HasAdministrator` trait supplies a `before()` that grants everything to the `admin` role. Register new policies in `AuthServiceProvider::$policies` (`PaymentPolicy` and `SaleReturnPolicy` exist but are **not registered yet**).
- Stock gates (`view-stock`, `edit-stock`, `empty-stock`) are defined in `app/Gates/StockValidations.php`, instantiated via `$this->app->make('stockValidations')` from `AuthServiceProvider::boot()`.
- Impersonation: `ImpersonationController` + `session('impersonation_id')`.
- Auth screens are Laravel Fortify (`app/Actions/Fortify`, `FortifyServiceProvider`, custom `App\Http\Responses\RegisterResponse`).

### Frontend

No router — Blade views under `resources/views` render one or two Vue components and pass server data as JSON props (`:sale="{{ json_encode($sale) }}"`).

- **Every component must be globally registered in `resources/js/app.js`** (`app.component('sale-component', …)`); a component file alone does nothing.
- Vuex store (`resources/js/vuex/`) holds the current user, the purchase cart (mirrored in `localStorage`), and errors. `SET_USER` reads `<meta name="current_user">` injected by `resources/views/layouts/app.blade.php` via the `CurrentUser` facade — the frontend never fetches the user on boot.
- `v-can="'edit sale'"` directive (defined in `app.js`) hides elements unless the user is admin or holds the permission. It's cosmetic — always enforce with a policy/gate server-side too.
- Cross-component messaging uses a `mitt` bus exposed as `window.EventBus` (`$on/$emit/$off`).
- `Errors`, `Notify`, `Authorizations` are **global mixins**; `getErrors(err)` flattens Laravel `422` payloads and redirects to `/403` on 403. `resources/js/bootstrap.js` sets the CSRF header and redirects to `/login?session_expired=1` on 401/419.
- Tailwind 3 via the PostCSS block in `vite.config.mjs`; `vue` is aliased to the **runtime+compiler** build, so in-DOM/`template:` strings work.

## Gotchas

- `routes/web.php` repeats `->middleware('auth', 'context.inventory')` per route rather than grouping — keep the existing style so nothing silently loses the inventory context.
- Sale/purchase state hides in the session, so "the cart is wrong" bugs are usually a stale `sale_id`/`purchase_id`, not the database.
- `Product::$hidden` hides `distributor_price`; endpoints that need it call `makeVisible('distributor_price')` (see `ProductsSearchController`).
- `database/migrations/2026_08_17_182559_add_direction_to_payments_table.php.php` has a doubled extension.
- `TODO.md` tracks known open work.
