<template>
    <div>
        <form class="py-4" @submit.prevent="submit" v-can="'create sale'">
            <div v-if="localSale != null">
                <div
                    class="w-full flex flex-wrap md:justify-between mb-2 text-gray-600 "
                >
                    <div v-if="sale">
                        ID Venta - #{{sale.id}}
                    </div>
                    <div>
                        {{typeOfSale}}
                    </div>
                    <sale-to-customer/>
                    <div v-show="getStatus" class="md:w-64 w-full flex justify-center items-center">
                        <p class="mr-2">Status:</p>
                        <p>{{ getStatus }}</p>
                    </div>
                    <div>
                        <delete-sale></delete-sale>
                    </div>
                </div>
                <div
                    v-show="products.length"
                    class=" flex flex-wrap justify-center items-center text-center mb-4"
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
            <div
                v-if="false"
                class="flex items-center border-b border-teal-500 py-2 mb-4"
            >
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
                v-show="products.length"
                class="  rounded transition-all duration-500 ease-in-out  font-semibold hover:text-black py-2 px-4 border-l-2 border-r-2 border-green-500 hover:bg-red-500 hover:border-transparent w-full"
                :class="[getClass]"
            >
                Cambiar a {{ modifyTo }}
            </button>
        </form>
        <div v-if="localSale !== null">
            <cart-product
                v-for="(product, index) in products"
                :key="product.id"
                :product="product"
                :sale-status="getStatus"
                :index="index"
            >
            </cart-product>
        </div>
    </div>
</template>
<script>
import CartProduct from "./CartProduct";
import {  mapMutations } from "vuex";
import Errors from "../../mixins/Errors";
import DeleteSale from './DeleteSale.vue';
export default {
    components: { "cart-product": CartProduct , DeleteSale},
    mixins: [Errors],
    data() {
        return {
            form: {},
            products: [],
            localSale: {},
            sale_status: null
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
        EventBus.$on("product-removed", index => {
            this.products.splice(index, 1);
        });
        EventBus.$on('sale-deleted',res => {
            if(res){
                this.products = [];
                this.localSale = {};
                this.form = {}
                this.sale_status = null;
            }
        })
    },
    computed: {
        getClass() {
            if (this.getStatus == "pending")
                return "hover:bg-green-500 text-green-700 bg-green-300";
            if (this.getStatus == "completed")
                return "hover:bg-yellow-500 text-yellow-700 bg-yellow-300";
        },
        getTotal() {
            var total = 0;
            this.products.map(product => {
                total += product.sale_price * product.sale_quantity;
            });
            return total.toFixed(2);
        },
        getStatus() {
            return this.sale_status ? this.sale_status : this.localSale?.status;
        },
        modifyTo() {
            if (this.getStatus == "pending") return "Completada";
            if (this.getStatus == "completed") return "Pendiente";
        },
        typeOfSale(){
            return this.sale?.client_id ? 'Venta a cliente' : 'Venta a publico en general';
        }
    },
    methods: {
        ...mapMutations(["setSalePriceOption"]),
        submit() {
            this.form.inventory_id = this.isAdmin
                ? sessionStorage.getItem("inventory_id")
                : this.user.inventory_id;
            if (this.getStatus === "pending") this.form.status = "completed";
            else this.form.status = "pending";
            axios
                .post(`/sales/${this.localSale.id}`, this.form)
                .then(res => {
                    this.sale_status = res.data.sale_status;
                    if (this.sale_status == "completed") {
                        sessionStorage.removeItem("salePriceOption");
                    }
                })
                .catch(err => {
                    this.getErrors(err);
                });
        }
    }
};
</script>
