<template>
    <form>
        <div class="flex items-center border-b border-teal-500 py-2 mb-4">
            <input
                v-model="form.sku"
                name="sku"
                class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
                type="number"
                placeholder="Número del cliente"
                aria-label="Full name"
            />
        </div>
        <div v-if="sale !== null">
            <cart-product 
                v-for="product in sale.products" 
                :key="product.id"
                :product="product"
            >
            </cart-product>
        </div>
    </form>
</template>
<script>
import CartProduct from "./CartProduct";
export default {
    components: { "cart-product": CartProduct },
    data() {
        return {
            form: {}
        };
    },
    props: {
        sale: {
            type: Object
        }
    },
    created() {
        if (this.sale != null) {
            console.log(this.sale);
        }
    }
};
</script>
