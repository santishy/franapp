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
import Notifications from 'vue-notification'
Vue.component('notifications', Notifications);
Vue.use(Notifications);
import { store } from './vuex/store.js';
const app = new Vue({
    el: "#app",
    store,
});