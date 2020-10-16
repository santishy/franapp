require('./bootstrap');
window.Vue = require('vue');
console.log('hola')
Vue.component('nav-component',require('./components/NavComponent.vue').default)
Vue.component('dropdown-component',require('./components/DropdownComponent.vue').default);
const app = new Vue({
    el : "#app"
});