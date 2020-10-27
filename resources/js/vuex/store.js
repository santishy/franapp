import Vue from 'vue';
import Vuex from 'vuex';
Vue.use(Vuex)

import actions from './actions'
import mutations from './mutations'
import getters from './getters';

export const store = new Vuex.Store({
  state:{
    productsInPurchase:localStorage.getItem('productsInPurchase'),
  },
  mutations,
  actions,
  getters,
})