<template>
    <div class="w-full">
        <search-component class="w-full mx-auto"></search-component>
        <product-matching></product-matching>
        <div class="flex justify-center items-center mt-4">
            <div class="bg-white px-4 py-2 w-3/4">
                <sale-form></sale-form>
            </div>
        </div>
    </div>
</template>
<script>
import ProductMatching from "../products/ProductMatching.vue";
import SearchComponent from "../products/SearchComponent.vue";
import SaleForm from "./SaleForm";
export default {
    components: { SearchComponent, SaleForm, ProductMatching }
};
</script>
