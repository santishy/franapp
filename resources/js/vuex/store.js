import Vue from 'vue';
import Vuex from 'vuex';
Vue.use(Vuex)

import actions from './actions'
import mutations from './mutations'
import getters from './getters';

export const store = new Vuex.Store({
  state:{
    numberOfProductsInPurchase:localStorage.getItem('numberOfProductsInPurchase'),
  },
  mutations,
  actions,
  getters,
})