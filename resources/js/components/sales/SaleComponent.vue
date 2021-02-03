<template>
    <div v-if="salePriceOption == null" class="w-full flex justify-center">
        <sale-price-options></sale-price-options>
    </div>
    <div v-else class="w-full">
        <div class="flex justify-center">
            <search-component class="sm:w-64 w-4/5 mx-auto"></search-component>
        </div>
        <product-matching></product-matching>
        <div class="flex flex-wrap justify-center items-center mt-4">
            <div class="bg-white px-4 py-2 w-4/5 rounded shadow">
                <sales-cart :sale="sale"></sales-cart>
            </div>
        </div>
    </div>
</template>
<script>

import ProductMatching from "../products/ProductMatching.vue";
import SearchComponent from "../products/SearchComponent.vue";
import SalePriceOptions from "./SalePriceOptions.vue";
import {mapState,mapMutations} from "vuex";
import SalesCart from "./SalesCart";

export default {
    components: {
        SearchComponent,
        SalesCart,
        ProductMatching,
        SalePriceOptions
    },
    props: {
        sale: {
            type: Object
        }
    },
    computed:{
        ...mapState(['salePriceOption'])
    }
};
</script>
