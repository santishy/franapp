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
    //Vue.set(state.productsInPurchase,state.productsInPurchase[])
}

export default {
    setProductsInPurchase
}