<template>
    <div class="grid md:grid-cols-5 gap-4">
        <product-in-purchase
            v-for="product in productsInPurchase"
            :product='product'
            :key="product.id"
        />
    </div>
</template>
<script>
import ProductInPurchase from './ProductInPurchase.vue';
export default {
    components:{
        'product-in-purchase':ProductInPurchase
    },
    props:{
        productsInPurchase:{
            type:Array
        }
    },
    data(){
        return{
            localProductsInPurchase:this.productsInPurchase
        }
    }
}
</script>