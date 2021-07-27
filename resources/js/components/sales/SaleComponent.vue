<template>
    <nav-component>
        <transition name="fade">
            <div
                v-if="seletedInventoryId == null && isAdmin"
                class="flex flex-col justify-center mx-auto md:w-1/3 w-full"
            >
                <p
                    class="border border-blue-400 px-4 py-2 text-blue-600 rounded bg-white mb-2 text-center"
                >
                    Al ser un usuario administrador, puedes elegir el inventario
                    para realizar la venta
                </p>
                <inventory-list></inventory-list>
            </div>
            <div v-else class="w-full mt-24 md:mt-32">
                <div class="flex justify-center">
                    <search-by-category
                        class="sm:w-64 w-4/5 md:mr-4"
                        :categories="categories"
                    ></search-by-category>
                    <search-component class="sm:w-64 w-4/5"></search-component>
                </div>
                <product-matching></product-matching>
                <div class="flex flex-wrap justify-center items-center mt-4">
                    <div
                        class="bg-white px-4 py-2 md:w-4/5 w-full md:mx-0 mx-2 rounded shadow"
                    >
                        <div
                            :class="[
                                'flex flex-wrap px-2 py-2 items-center mb-4 border-b-2 border-blue-400',
                                alignStatus
                            ]"
                        >
                            <div class="text-gray-600 " v-if="sale_status">
                                ID Venta - #{{ sale.id }}
                            </div>
                            <div class="text-xl text-gray-700">
                                {{ typeOfSale }}
                            </div>
                            <div
                                v-show="getStatus"
                                class="flex flex-wrap text-gray-600"
                            >
                                <p class="mr-2 text-xs">Status:</p>
                                <p class="text-xs">{{ getStatus }}</p>
                            </div>
                        </div>
                        <div
                            class="w-full flex flex-wrap md:justify-center mb-2 text-gray-600 md:items-center"
                        >
                            <sale-to-customer  v-if="show" />
                            <button
                                v-else
                                @click="show = true"
                                class="bg-teal-300 rounded transition-all duration-500 ease-in-out hover:bg-teal-500 text-teal-700 font-semibold hover:text-white py-1 px-4 border-b-2 border-teal-500 hover:border-transparent mr-1"
                            >
                                Cliente registrado
                            </button>
                            <delete-sale v-show="sale_status"></delete-sale>
                        </div>

                        <sales-cart :sale="sale"></sales-cart>
                    </div>
                </div>
            </div>
        </transition>
    </nav-component>
</template>
<script>
import ProductMatching from "../products/ProductMatching.vue";
import SearchComponent from "../products/SearchComponent.vue";
import InventoryList from "../inventories/InventoryList.vue";
import { mapState } from "vuex";
import SalesCart from "./SalesCart";
import NavComponent from "../NavComponent.vue";
import SaleToCustomer from "./SaleToCustomer.vue";
import SearchByCategory from "../products/SearchByCategory.vue";
import DeleteSale from "./DeleteSale.vue";
export default {
    components: {
        SearchComponent,
        SalesCart,
        ProductMatching,
        InventoryList,
        NavComponent,
        SaleToCustomer,
        SearchByCategory,
        DeleteSale
    },
    props: {
        sale: {
            type: Object
        },
        categories: {
            type: Array
        }
    },
    created() {
        if (this.sale) {
            this.sale_status = this.sale.status;
        }
        EventBus.$on("selected-inventory", inventary_id => {
            this.seletedInventoryId = inventary_id;
        });
        EventBus.$on("sale-deleted", res => {
            if (res) {
                this.sale_status = null;
            }
        });
        EventBus.$on("product-added-sales-cart", sale => {
            this.sale_status = sale.status;
        });
        EventBus.$on("sale-to-client", data => {
            this.sale_status = data.sale.status;
        });
    },
    data() {
        return {
            seletedInventoryId: null,
            show: false,
            sale_status: null
        };
    },
    computed: {
        ...mapState(["salePriceOption"]),
        typeOfSale() {
            return this.sale?.client_id
                ? "Venta a " + this.sale?.client?.name
                : "Venta a publico en general";
        },
        getStatus() {
            return this.sale_status ? this.sale_status : this.sale?.status;
        },
        alignStatus() {
            return this.sale ? "justify-between" : "justify-center";
        }
    }
};
</script>
