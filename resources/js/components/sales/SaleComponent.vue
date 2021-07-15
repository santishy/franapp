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
                    <search-component
                        class="sm:w-64 w-4/5 mx-auto"
                    ></search-component>
                </div>
                <product-matching></product-matching>
                <div class="flex flex-wrap justify-center items-center mt-4">
                    <div
                        class="bg-white px-4 py-2 md:w-4/5 w-full md:mx-0 mx-2 rounded shadow"
                    >
                        <sale-to-customer/>
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
import SaleToCustomer from './SaleToCustomer.vue';
export default {
    components: {
        SearchComponent,
        SalesCart,
        ProductMatching,
        InventoryList,
        NavComponent,
        SaleToCustomer
    },
    props: {
        sale: {
            type: Object
        }
    },
    created() {
        EventBus.$on("selected-inventory", inventary_id => {
            this.seletedInventoryId = inventary_id;
        });
    },
    data() {
        return {
            seletedInventoryId: null
        };
    },
    computed: {
        ...mapState(["salePriceOption"])
    }
};
</script>
