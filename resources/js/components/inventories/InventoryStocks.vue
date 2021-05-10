<template>
    <div class="w-full mt-24 md:mt-32 flex">
        <div class="w-1/5 px-2">
            <inventory-list></inventory-list>
        </div>
        <div class="w-4/5">
            <product-list></product-list>
        </div>
    </div>
</template>

<script>
import InventoryList from "./InventoryList.vue";
import ProductList from "./ProductList";
export default {
    components: { ProductList, InventoryList },
    props: {
        InventoryListinventories: {
            type: Array
        }
    }
};
</script>
