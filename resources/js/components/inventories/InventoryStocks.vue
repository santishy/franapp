<template>
    <layout-component>
        <div class="w-full px-4 mx-auto  flex flex-wrap max-w-full overscroll-auto" v-can="'view warehouses'">
            <!-- <div class="w-full max-w-full mb-1">
                <inventory-list></inventory-list>
            </div> -->
            <div class="w-full max-w-full ">
                <product-list></product-list>
            </div>
        </div>
    </layout-component>
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
