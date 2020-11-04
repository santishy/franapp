<template>
    <div class="grid md:grid-cols-5 md:grid-rows-2 gap-4 ">
        <div class="col-span-2 row-span-1 shadow bg-white rounded px-2 py-4">
            <h3 class="text-2xl font-semibold text-center py-2 px-2 mb-4">Compra</h3>
            <div class="grid md:grid-cols-2 text-center">
                <p class="mr-4 text-2xl text-gray-800">Total Compra:</p>
                <p class="text-2xl text-gray-800">${{new Intl.NumberFormat('es-MX').format(localTotalPurchase)}}</p>
                <p class="text-xl text-right text-gray-800">Status:</p>
                <p></p>
            </div>
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
        },
        totalPurchase:{
            type:Number
        }
    },
    mounted() {
        EventBus.$on("purchase-extracted", this.removeProductFromPurchase);
        EventBus.$on("total-updated-purchase",this.changeTotal);
    },
    data() {
        return {
            localProductsInPurchase: this.productsInPurchase,
            localTotalPurchase:this.totalPurchase
        };
    },
    methods: {
        removeProductFromPurchase(index) {
            console.log(index)
            this.localProductsInPurchase.splice(index, 1);
        },
        changeTotal(newTotalPurchase){
            this.localTotalPurchase = newTotalPurchase;
        }
    }
};
</script>
