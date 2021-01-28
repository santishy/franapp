<template>
    <div>
        <form class="py-4">
            <div v-if="localSale != null" class=" flex flex-wrap ">
                <label class="mr-4">Total</label>
                <p>{{ getTotal }}</p>
                <input name="total" type="hidden" :value="getTotal">
            </div>

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
            <button
                class=" bg-green-300 rounded transition-all duration-500 ease-in-out hover:bg-green-500 text-green-700 font-semibold hover:text-white py-2 px-4 border-l-2 border-r-2 border-green-500 hover:border-transparent w-full"
            >
                Completar
            </button>
        </form>
        <div v-if="localSale !== null">
            <cart-product
                v-for="product in products"
                :key="product.id"
                :product="product"
            >
            </cart-product>
        </div>
    </div>
</template>
<script>
import CartProduct from "./CartProduct";
export default {
    components: { "cart-product": CartProduct },
    data() {
        return {
            form: {},
            products:[],
            localSale:null
        };
    },
    props: {
        sale: {
            type: Object
        }
    },
    created() {
        if (this.sale != null) {
            this.localSale = this.sale ;
            this.products = this.sale.products ; 

        }
    },
    mounted(){
        EventBus.$on('product-added-sales-cart',(res)=>{
            this.localSale = res;
            this.products = res.products;
        })
    },
    computed:{
        getTotal(){
            var total=0;
            this.products.map( product => {
                total += product.retail_price * product.sale_quantity;
            })
            return total;
        }
    }
};
</script>
