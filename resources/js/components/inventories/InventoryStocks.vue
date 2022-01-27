<template>
    <nav-component>
        <div  class="w-full px-4 mx-auto  flex flex-wrap max-w-full overscroll-auto" v-can="'view warehouses'">
            <div class="w-full max-w-full sm:w-1/5 ">
                <inventory-list></inventory-list>
            </div>
            <div class="w-full max-w-full sm:w-4/5">
                <product-list></product-list>
            </div>
        </div>
    </nav-component>
</template>

<script>
import InventoryList from "./InventoryList.vue";
import ProductList from "./ProductList";
import NavComponent from "../NavComponent.vue";
export default {
    components: { ProductList, InventoryList, NavComponent },
    props: {
        InventoryListinventories: {
            type: Array
        }
    }
};
</script>
