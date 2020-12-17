<template>
    <div v-if="isOpen" class="fixed inset-0 flex items-center justify-center ">
        <div @click="isOpen = false" class="fixed inset-0 z-10"></div>
        <div
            class="w-10/12 shadow z-20 h-screen overflow-y-scroll overflow-x-hidden bg-white py-4 px-6"
        >
            <div class="grid md:grid-cols-3 grid-cols-1 gap-4 ">
                <product-card
                    v-for="product in products"
                    :key="product.id"
                    :product="product"
                >
                </product-card>
            </div>
        </div>
    </div>
</template>
<script>
import ProductCardComponent from "./ProductCardComponent";
export default {
    data() {
        return {
            products: [],
            isOpen: false,
        };
    },
    created() {
        EventBus.$on("matching-products", obj => {
            this.products = obj.products;
            this.isOpen = true;
        });
    },
    components: {
        "product-card": ProductCardComponent
    },
    computed: {}
};
</script>
