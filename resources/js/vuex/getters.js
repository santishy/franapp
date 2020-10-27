const getNumberOfProductsInPurchase = state => state.numberOfProductsInPurchase;

const hasProductsInPurchase = state => !(state.productsInPurchase === null);

export default{
    getNumberOfProductsInPurchase,
    hasProductsInPurchase,
}