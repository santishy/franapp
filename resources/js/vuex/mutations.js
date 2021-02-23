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
    // muy probablemente el index este mal en esta busqueda
    var products = JSON.parse(localStorage.getItem('productsInPurchase'));
    console.log(products);
    products.splice(index, 1);
    console.log(index)
    localStorage.setItem('productsInPurchase', JSON.stringify(products));
    state.productsInPurchase = JSON.parse(localStorage.getItem('productsInPurchase'));
}

const toggleActiveSearchCategory = (state, status) => {
    state.activeSearchCategory = status;
}

const setSalePriceOption = (state, value) => {
    state.salePriceOption = value;
}
export default {
    setProductsInPurchase,
    toggleActiveSearchCategory,
    setSalePriceOption,
    deleteProductInPurchase
}