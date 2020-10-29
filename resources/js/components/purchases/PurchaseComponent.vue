<template>
    <div class="grid md:grid-cols-5 gap-4">
        <product-in-purchase
            v-for="(product,index) in productsInPurchase"
            :product='product'
            :index="index"
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
    mounted(){
        EventBus.$on('deleted-from-purchase',this.removeProductFromPurchase)
    },
    data(){
        return{
            localProductsInPurchase:this.productsInPurchase
        }
    },
    removeProductFromPurchase(index){
        this.localProductsInPurchase.splice(index,1);
    }
}
</script>