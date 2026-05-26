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
