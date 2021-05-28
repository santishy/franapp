require('./bootstrap');
window.Vue = require('vue');
window.EventBus = new Vue();
import Vuex from 'vuex'

Vue.use(Vuex)

Vue.component('nav-component', require('./components/NavComponent.vue').default)
Vue.component('errors-component', require('./components/ErrorsComponent.vue').default)
Vue.component('dropdown-component', require('./components/DropdownComponent.vue').default);
Vue.component('product-form', require('./components/products/ProductForm.vue').default);
Vue.component('products-index', require('./components/products/IndexComponent.vue').default);
Vue.component('purchase-component', require('./components/purchases/PurchaseComponent.vue').default)
Vue.component('product-in-purchase', require('./components/purchases/ProductInPurchase.vue').default)
Vue.component('client-form', require('./components/clients/ClientForm.vue').default)
Vue.component('client-list', require('./components/clients/ClientList.vue').default)

//CATEGORIES COMPONENTS
Vue.component('category-form', require('./components/categories/CategoryForm.vue').default)
Vue.component('category-list', require('./components/categories/CategoryList.vue').default)

//VENTAS COMPONENTES
Vue.component('sale-component',require('./components/sales/SaleComponent').default)
Vue.component('transaction-report',require('./components/reports/Transactions').default)


//transactions
Vue.component('transaction-list',require('./components/reports/TransactionList.vue').default);

//auth
Vue.component('register-component',require('./components/auth/Register.vue').default);

//roles
Vue.component('create-new-role',require('./components/auth/CreateNewRole.vue').default);
Vue.component('assign-role',require('./components/auth/AssignRole.vue').default);

//permissions
Vue.component('permission-list',require('./components/auth/PermissionList.vue').default);

//users 
Vue.component('user-list',require('./components/users/UserList.vue').default);

//inventories
Vue.component('create-inventory',require('./components/inventories/CreateInventory.vue').default)
Vue.component('inventory-stocks',require('./components/inventories/InventoryStocks.vue').default)

import Notifications from 'vue-notification'
Vue.component('notifications', Notifications);
Vue.use(Notifications);
import { store } from './vuex/store.js';
import Errors from "./mixins/Errors";

store.dispatch('getUser');

Vue.mixin(Errors);
Vue.mixin(Authorizations);


import Vue from 'vue';
import Authorizations from './mixins/Authorizations.js';
const app = new Vue({
    el: "#app",
    store,
});