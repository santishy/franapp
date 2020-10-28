const setProductsInPurchase = (state, data) => {
    var localProductsInPurchase = JSON.parse(localStorage.getItem('productsInPurchase'));
    if (data.hasProductsinPurchase) {
        if (data.index == -1) {
            localProductsInPurchase.push(data.productInPurchase);
            
        } else {
            console.log('holaaaaaaaaaaaa')
            localProductsInPurchase[data.index].qty = data.productInPurchase.qty;
            console.log(localProductsInPurchase)
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

export default{
    setProductsInPurchase
}