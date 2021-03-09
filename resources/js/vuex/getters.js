

const hasProductsInPurchase = state => !(state.productsInPurchase === null);

const productExistsInPurchase = (state) => {

    return function (product_id) {
        if (state.productsInPurchase === null)
            return -1;
        return state.productsInPurchase.findIndex(product => product.product_id === product_id)
    };
}

const qtyPurchase = (state) => {
    return (index) => {
        if (index == -1)
            return null;
        return state.productsInPurchase[index].qty;
    }
}

export default {
    hasProductsInPurchase,
    productExistsInPurchase,
    qtyPurchase
}