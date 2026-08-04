import './bootstrap';
import mitt from 'mitt';
import { createApp } from 'vue';
import InfiniteLoading from 'v3-infinite-loading/lib/v3-infinite-loading.es.js';
import 'v3-infinite-loading/lib/style.css';

import Notifications from '@kyvg/vue3-notification'
import { store } from './vuex/store.js';
import Errors from "./mixins/Errors";
import Notify from "./mixins/Notify";
import Authorizations from './mixins/Authorizations.js';
import LayoutComponent from './components/LayoutComponent.vue';
import ErrorsComponent from './components/ErrorsComponent.vue';
import DropdownComponent from './components/DropdownComponent.vue';
import ProductForm from './components/products/ProductForm.vue';
import ProductsIndex from './components/products/IndexComponent.vue';
import PurchaseComponent from './components/purchases/PurchaseComponent.vue';
import ClientForm from './components/clients/ClientForm.vue';
import ClientList from './components/clients/ClientList.vue';
import CategoryForm from './components/categories/CategoryForm.vue';
import CategoryList from './components/categories/CategoryList.vue';
import CategoryIndex from './components/categories/Index.vue';
import EditCategory from './components/categories/EditCategory.vue';
import SaleComponent from './components/sales/SaleComponent.vue';
import TransactionReport from './components/reports/Transactions.vue';
import TransactionList from './components/reports/TransactionList.vue';
import RegistrationForm from './components/auth/RegistrationForm.vue';
import Register from './components/auth/Register.vue';
import CreateNewRole from './components/auth/CreateNewRole.vue';
import AssignRole from './components/auth/AssignRole.vue';
import RoleComponent from './components/auth/RoleComponent.vue';
import PermissionList from './components/auth/PermissionList.vue';
import UserList from './components/users/UserList.vue';
import CreateInventory from './components/inventories/CreateInventory.vue';
import InventoryStocks from './components/inventories/InventoryStocks.vue';
import EditWarehouse from './components/warehouses/EditWarehouse.vue';
import WarehouseList from './components/warehouses/WarehouseList.vue';
import Dashboard from './components/Dashboard.vue';
import Forbidden from './components/errors/Forbidden.vue';
import TicketForm from './components/tickets/TicketForm.vue';
import SelectInventory from './components/inventories/SelectInventory.vue';


const emitter = mitt();

window.EventBus = {
    $on: (event, callback) => emitter.on(event, callback),
    $emit: (event, data) => emitter.emit(event, data),
    $off: (event, callback) => emitter.off(event, callback),
}
store.commit('SET_USER');

const app = createApp({});

app.use(Notifications);

app.config.compilerOptions.whitespace = 'preserve';
app.mixin(Errors);
app.mixin(Authorizations);
app.mixin(Notify);

app.component('infinite-loading', InfiniteLoading);
app.component('layout-component', LayoutComponent)
app.component('errors-component', ErrorsComponent)
app.component('dropdown-component', DropdownComponent);
app.component('product-form', ProductForm);
app.component('products-index', IndexComponent);
app.component('purchase-component', PurchaseComponent)
//Vue.component('product-in-purchase', purchases/ProductInPurchase)
app.component('client-form', ClientForm)
app.component('client-list', ClientList)

//CATEGORIES COMPONENTS
app.component('category-form', CategoryForm)
app.component('category-list', CategoryList)
app.component('category-index',Index)
app.component('edit-category', EditCategory)

//VENTAS COMPONENTES
app.component('sale-component',SaleComponent)
app.component('transaction-report', Transactions)


//transactions
app.component('transaction-list', TransactionList);

//auth
app.component('registration-form', RegistrationForm);
app.component('register',Register);

//roles
app.component('create-new-role', CreateNewRole);
app.component('assign-role', AssignRole);
app.component('role-component', RoleComponent)

//permissions
app.component('permission-list', PermissionList);

//users
app.component('user-list', UserList);

//inventories
app.component('create-inventory', CreateInventory)
app.component('inventory-stocks', InventoryStocks)
app.component('edit-warehouse', EditWarehouse);

//Inventories -> warehouses

app.component('warehouse-list',WarehouseList);

//dashboard
app.component('dashboard', Dashboard);

//errors
app.component('forbidden',Forbidden);

/**
 * tickets
 */
app.component('ticket-form', TicketForm);
//select inventory
app.component('select-inventory', SelectInventory);

app.directive('can',
    async function (el, binding) {
        if (store.getters.isAdmin || store.state.user?.permissions?.includes(binding.value))
            return;
        el.style.display = 'none';
    }
);

app.use(store)
app.mount('#app')
