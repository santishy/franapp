import Vue from 'vue';
import Vuex from 'vuex';
Vue.use(Vuex)

import actions from './actions'
import mutations from './mutations'
import getters from './getters';

export const store = new Vuex.Store({
  state:{
    productsInPurchase:JSON.parse(localStorage.getItem('productsInPurchase')),
    purchaseStatus:'',
    activeSearchCategory:true,
  },
  mutations,
  actions,
  getters,
})