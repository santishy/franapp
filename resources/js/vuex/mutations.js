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

const toggleActiveSearchCategory = (state, status) => {
    state.activeSearchCategory = status;
}

const setSalePriceOption = (state, value) => {
    state.salePriceOption = value;
}

const addToTransaction = (staten, data) => {
    state.productsInTransaction.unshift(data);
}
export default {
    setProductsInPurchase,
    toggleActiveSearchCategory,
    setSalePriceOption,
    deleteProductInPurchase,
    addToTransaction
}