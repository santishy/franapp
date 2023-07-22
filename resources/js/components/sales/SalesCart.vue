<template>
    <div>
        <form @submit.prevent="submit" v-can="'create sale'">
            <div v-if="errors" class="flex items-center mb-3">
                <errors-component :errors="errors" />
            </div>
            <div v-if="localSale != null" class="flex justify-end">
                <div v-show="products.length">
                    <input name="total" type="hidden" :v-model="(form.total = getTotal)" />
                </div>
            </div>
            <div class="flex flex-wrap justify-end">
                <button v-show="products.length" class="
                        rounded
                        transition-all
                        duration-500
                        ease-in-out
                        font-bold
                        mb-2

                        py-2
                        px-4

                    " :class="[getClass]">
                    {{ modifyTo }}
                </button>
            </div>
        </form>
        <div v-if="localSale !== null" class="relative md:max-h-80 overflow-y-auto shadow-inner p-2">
            <product-list>
                <product-list-item v-for="(product, index) in products" :key="product.id" :product="product"
                    :sale-status="getStatus" :index="index">
                </product-list-item>
            </product-list>
        </div>
        <div v-if="localSale != null" class="mt-2 flex justify-end">
            <div v-show="products.length" class="
                        flex flex-wrap
                        justify-center
                        items-center
                        md:w-64
                        px-4
                        py-2
                        rounded
                        bg-amber-300
                    ">
                <label class="mr-4 text-2xl font-semibold text-secondary">Total</label>
                <p class="text-secondary text-3xl  font-semibold">${{ getTotal }}</p>
            </div>
        </div>
    </div>
</template>
<script>
import ProductListItem from "./ProductListItem";
import ProductList from "./ProductList.vue";
import { mapMutations } from "vuex";
import Errors from "../../mixins/Errors";

export default {
    components: { ProductListItem, ProductList },
    mixins: [Errors],
    data() {
        return {
            form: {},
            products: [],
            localSale: {},
        };
    },
    props: {
        sale: {
            type: Object,
        },
    },
    created() {
        if (this.sale != null) {
            this.localSale = this.sale;
            this.products = this.sale.products;
        }
    },
    mounted() {
        EventBus.$on("updated-sales-product", (obj) => {
            this.products[obj.index].sale_quantity = obj.transaction.qty;
            this.products[obj.index].sale_price = obj.transaction.sale_price;
        });
        EventBus.$on("product-added-sales-cart", (res) => {
            this.localSale = res;
            this.products = res.products;
        });
        EventBus.$on("product-removed", (index) => {
            this.products.splice(index, 1);
        });
        EventBus.$on("sale-deleted", (res) => {
            if (res) {
                this.products = [];
                this.localSale = {};
                this.form = {};
            }
        });
        EventBus.$on("sale-to-client", (data) => {
            this.localSale = data.sale;
        });
        EventBus.$on("update-cart", data => this.updateCart(data))
    },
    computed: {
        getClass() {
            if (this.getStatus == "pending")
                return "bg-sky-600 text-slate-100 hover:bg-sky-300 hover:text-sky-600";
            if (this.getStatus == "completed")
                return "bg-lime-300 text-slate-600 hover:bg-slate-100 hover:text-slate-800";
        },
        getTotal() {
            var total = 0;
            this.products.map((product) => {
                total += product.sale_price * product.sale_quantity;
            });
            return total.toFixed(2);
        },

        modifyTo() {
            if (this.localSale.status == "pending") return "Finalizar Venta";
            if (this.localSale.status == "completed") return "Modificar Venta";
        },
        getStatus() {
            return this.localSale.status;
        },
    },
    methods: {
        submit() {
            this.form.inventory_id = this.isAdmin
                ? sessionStorage.getItem("inventory_id")
                : this.user.inventory_id;
            if (this.getStatus === "pending") this.form.status = "completed";
            else this.form.status = "pending";
            axios
                .post(`/sales/${this.localSale.id}`, this.form)
                .then((res) => {
                    this.localSale.status = res.data.sale_status;
                    if (this.localSale.status == "completed") {
                        sessionStorage.removeItem("salePriceOption");
                    }
                    window.open(`/pdf-tickets/${this.localSale.id}`, "_blank");
                })
                .catch((err) => {
                    this.getErrors(err);
                    this.$notify({
                        group: "foo",
                        title: "Error",
                        type: "error",
                        text: this.errors[0],
                    });
                });
        },
        async updateCart(data) {
            try {

                const res = await axios.post(`/sales/${data?.product_id}/products`,
                    { _method: 'put', ...data }
                );
                EventBus.$emit('enabled');

            } catch (error) {
                this.getErrors(error);
                this.$notify({
                    group: "foo",
                    title: "Error",
                    type: "error",
                    text: this.errors[0],
                });
            }
        }
    },
};
</script>
