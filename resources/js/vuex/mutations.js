const setProductsInPurchase = (state, data) => {
    var localProductsInPurchase = JSON.parse(localStorage.getItem('productsInPurchase'));
    if (data.hasProductsInPurchase) {
        if (data.index != -1) {
            localProductsInPurchase[data.index].qty = data.productInPurchase.qty;
        } else {
            localProductsInPurchase.push(data.productInPurchase);
        }
    }
    else {
        localProductsInPurchase = [];
        localProductsInPurchase.push(data.productInPurchase)
    }
    localStorage.setItem('productsInPurchase', JSON.stringify(localProductsInPurchase));
    state.productsInPurchase = JSON.parse(localStorage.getItem('productsInPurchase'));
}

const deleteProductInPurchase = (state, index) => {
    var products = JSON.parse(localStorage.getItem('productsInPurchase'));
    products.splice(index, 1);
    localStorage.setItem('productsInPurchase', JSON.stringify(products));
    state.productsInPurchase = JSON.parse(localStorage.getItem('productsInPurchase'));
}

// const toggleActiveSearchCategory = (state, status) => {
//     state.activeSearchCategory = status;
// }

const setSalePriceOption = (state, value) => {
    state.salePriceOption = value;
}

const addToTransaction = (state, data) => {
    state.productsInTransaction.unshift(data);
}
const removeTransactionProduct = (state,id) => {
    
}
const SET_USER = (state,user) => 
{
    state.user = JSON.parse( document.head.querySelector("meta[name='current_user']").content);
    state.auth = Boolean(user);
}
export default {
    setProductsInPurchase,
    SET_USER,
    setSalePriceOption,
    deleteProductInPurchase,
    addToTransaction
}