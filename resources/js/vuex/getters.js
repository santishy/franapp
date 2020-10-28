

const hasProductsInPurchase = state => !(state.productsInPurchase === null);

const productExistsInPurchase = (state) => {
    if (state.productsInPurchase === null)
        return -1;
    return function (product_id) {
        return state.productsInPurchase.findIndex(product => product.product_id === product_id)
    };
}

const qtyPurchase = (state) => {
    return (index) => {
        if(index == -1)
            return null;
        return state.productsInPurchase[index].qty;
    }
}

export default {
    hasProductsInPurchase,
    productExistsInPurchase,
    qtyPurchase
}