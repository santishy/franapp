<template>
    <div class="grid md:grid-cols-5 md:grid-rows-2 gap-4 ">
        <div class="col-span-2 row-span-2 shadow">

        </div>
        <product-in-purchase
            v-for="(product, index) in localProductsInPurchase"
            :product="product"
            :index="index"
            :key="product.id"
        />
    </div>
</template>
<script>
//import ProductInPurchase from './ProductInPurchase.vue';
export default {
    // components:{
    //     'product-in-purchase':ProductInPurchase
    // },
    props: {
        productsInPurchase: {
            type: Array
        }
    },
    mounted() {
        EventBus.$on("purchase-extracted", this.removeProductFromPurchase);
    },
    data() {
        return {
            localProductsInPurchase: this.productsInPurchase
        };
    },
    methods: {
        removeProductFromPurchase(index) {
            console.log(index)
            this.localProductsInPurchase.splice(index, 1);
        }
    }
};
</script>
