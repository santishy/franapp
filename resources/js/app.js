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
Vue.component('category-search', require('./components/categories/CategorySearch.vue').default)


import Notifications from 'vue-notification'
Vue.component('notifications', Notifications);
Vue.use(Notifications);
import { store } from './vuex/store.js';
const app = new Vue({
    el: "#app",
    store,
});