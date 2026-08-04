import { createStore } from 'vuex';


import actions from './actions'
import mutations from './mutations'
import getters from './getters';



export const store = createStore({

  state:{
    productsInPurchase:JSON.parse(localStorage.getItem('productsInPurchase')),
    purchaseStatus:'',
    queryType:null,
    user:{},
    auth:false,
    errorsFound:null,
    salePriceOption:sessionStorage.getItem('salePriceOption'),
    productsInTransaction:[],
    modalDataConfirm:{},
    purchaseVisibility:window.localStorage.getItem("allow-to-buy-new-product")?.toUpperCase() === 'TRUE',
  },
  mutations,
  actions,
  getters,
})
