<template>
    <div class="w-full">
        <div class="flex justify-center">
            <search-component class="sm:w-64 w-4/5 mx-auto"></search-component>
        </div>
        <product-matching></product-matching>
        <div class="flex justify-center items-center mt-4">
            <div class="bg-white px-4 py-2 w-4/5">
                <sale-form :sale="sale"></sale-form>
            </div>
        </div>
    </div>
</template>
<script>
import ProductMatching from "../products/ProductMatching.vue";
import SearchComponent from "../products/SearchComponent.vue";
import SaleForm from "./SaleForm";
export default {
    components: { SearchComponent, SaleForm, ProductMatching },
    props: {
        sale: {
            type: Object
        }
    },
};
</script>
