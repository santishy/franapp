<template>
    <div>
        <form class="py-4" @submit.prevent="submit">
            <div v-if="localSale != null">
                <div
                    class="w-full flex flex-wrap justify-end mb-4 text-gray-600"
                >
                    <p class="mr-2">Status:</p>
                    <p>{{ getStatus }}</p>
                </div>
                <div
                    class=" flex flex-wrap justify-center items-center text-center"
                >
                    <label class="mr-4 text-2xl">Total</label>
                    <p class="text-gray-700 text-3xl">${{ getTotal }}</p>
                    <input
                        name="total"
                        type="hidden"
                        :v-model="(form.total = getTotal)"
                    />
                </div>
            </div>
            <div class="flex items-center border-b border-teal-500 py-2 mb-4">
                <input
                    v-model="form.phone_number"
                    name="phone_number"
                    class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
                    type="number"
                    placeholder="Número del cliente"
                    aria-label="Full name"
                />
            </div>
            <div v-if="errors" class="flex items-center mb-3">
                <errors-component :errors="errors" />
            </div>
            <button
                class=" bg-green-300 rounded transition-all duration-500 ease-in-out hover:bg-green-500 text-green-700 font-semibold hover:text-white py-2 px-4 border-l-2 border-r-2 border-green-500 hover:border-transparent w-full"
            >
                Completar
            </button>
        </form>
        <div v-if="localSale !== null">
            <cart-product
                v-for="(product, index) in products"
                :key="product.id"
                :product="product"
                :index="index"
            >
            </cart-product>
        </div>
    </div>
</template>
<script>
import CartProduct from "./CartProduct";
import { mapState } from "vuex";
import Errors from '../../mixins/Errors';
export default {
    components: { "cart-product": CartProduct },
    mixins:[Errors],
    data() {
        return {
            form: {},
            products: [],
            localSale: null,
            sale_status: null,
        };
    },
    props: {
        sale: {
            type: Object
        }
    },
    created() {
        if (this.sale != null) {
            this.localSale = this.sale;
            this.products = this.sale.products;
        }
    },
    mounted() {
        EventBus.$on("updated-sales-product", obj => {
            this.products[obj.index].sale_quantity = obj.transaction.qty;
            this.products[obj.index].sale_price = obj.transaction.sale_price;
        });
        EventBus.$on("product-added-sales-cart", res => {
            this.localSale = res;
            this.products = res.products;
        });
    },
    computed: {
        getTotal() {
            var total = 0;
            this.products.map(product => {
                total += product.sale_price * product.sale_quantity;
            });
            return total;
        },
        getStatus() {
            return this.sale_status ? this.sale_status : this.localSale.status;
        },
        ...mapState(["salePriceOption"])
    },
    methods: {
        submit() {
            this.form.status = "completed";
            axios
                .post(`/sales/${this.localSale.id}`, this.form)
                .then(res => {
                    this.sale_status = res.data.sale_status;
                })
                .catch(err => {
                    this.getErrors(err);
                });
        }
    }
};
</script>
