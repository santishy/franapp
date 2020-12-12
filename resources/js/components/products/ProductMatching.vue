<template>
    <div v-if="products.length">
        
        <div class="fixed inset-0 z-50  overflow-x-hidden overflow-y-auto flex justify-center p-4 ">
            <div class="grid  overflow-y-auto grid-cols-1 md:grid-cols-3 gap-4 p-4 relative w-3/4 bg-white">
                <product-card
                    v-for="product in products"
                    :key="product.id"
                    :product="product"
                >
                </product-card>
            </div>
        </div>
        <div
            
            class="absolute inset-0 opacity-25 bg-black z-40"
        ></div>
    </div>
</template>
<script>
import ProductCardComponent from "./ProductCardComponent";
export default {
    data() {
        return {
            products: []
        };
    },
    created() {
        EventBus.$on("matching-products", obj => {
            this.products = obj.products;
            console.log(obj.products);
        });
    },
    components: {
        "product-card": ProductCardComponent
    },
    computed: {}
};
</script>
