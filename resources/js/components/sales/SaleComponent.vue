<template>
    <nav-component>
        <div
            v-if="salePriceOption == null"
            class="w-full flex justify-center mx-auto border-2 border-red-500"
        >
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
                    <sales-cart :sale="sale"></sales-cart>
                </div>
            </div>
        </div>
    </nav-component>
</template>
<script>
import ProductMatching from "../products/ProductMatching.vue";
import SearchComponent from "../products/SearchComponent.vue";
import InventoryList from "../inventories/InventoryList.vue";
import { mapState } from "vuex";
import SalesCart from "./SalesCart";
import NavComponent from "../NavComponent.vue";
export default {
    components: {
        SearchComponent,
        SalesCart,
        ProductMatching,
        InventoryList,
        NavComponent
    },
    props: {
        sale: {
            type: Object
        }
    },
    computed: {
        ...mapState(["salePriceOption"])
    }
};
</script>
