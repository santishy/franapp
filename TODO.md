# TODO

## Ventas

- [ ] Bloquear en backend que una venta `completed` pueda volver a `pending`.

  Actualmente el frontend oculta el boton para modificar/reabrir una venta completada,
  pero `POST /sales/{sale}` todavia acepta `status: pending` en
  `SaleController@store`. Si la regla del sistema es que una venta completada ya no
  debe reabrirse, validar esto tambien en backend para evitar cambios manuales o
  peticiones directas.

  Archivos relacionados:
  - `app/Http/Controllers/SaleController.php`
  - `routes/web.php`
  - `resources/js/components/sales/SalesCart.vue`

## Errores (frontend)

- [ ] Corregir la prop de `errors-component` en `SalesCart.vue` y `CategorySearch.vue`.

  Pasan `:errors="errors"`, pero la prop del componente se llama `errorsFound`,
  asi que en esas dos pantallas la alerta de errores nunca se muestra.
  Debe ser `:errors-found="errors"`.

  Archivos relacionados:
  - `resources/js/components/sales/SalesCart.vue`
  - `resources/js/components/categories/CategorySearch.vue`

- [ ] Evitar el salto del contenido cuando aparece/desaparece la alerta de errores.

  La transicion `alert` solo anima `opacity` y `transform`, asi que el contenido
  de abajo (formularios) salta de golpe al insertarse o quitarse el div.

  Archivos relacionados:
  - `resources/js/components/ErrorsComponent.vue`
