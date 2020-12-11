<template>
    <div class="w-full grid ">
        <search-component></search-component>
        <product-matching></product-matching>
        <sale-form></sale-form>
    </div>
</template>
<script>
import ProductMatching from '../products/ProductMatching.vue';
import SearchComponent from '../products/SearchComponent.vue';
import SaleForm from './SaleForm';
export default {
    components:{SearchComponent,SaleForm, ProductMatching}
}
</script>