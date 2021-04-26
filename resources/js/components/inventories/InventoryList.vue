<template>
    <div class="w-full mt-24 md:mt-32 flex">
        <div class="w-1/5 px-2">
            <ul class="bg-white shadow-sm runded w-full text-center">
                <li v-for="inventory in inventories" :key="inventory.id">
                    <a href="#" class="block p-4" @click="selectedInventory(inventory)">{{ inventory.name }}</a>
                </li>
            </ul>
        </div>
        <div class="w-4/5">
            <product-list></product-list>
        </div>
    </div>
</template>

<script>
import ProductList from "./ProductList";
export default {
    components: { ProductList },
    props: {
        inventories: {
            type: Array
        }
    },
    methods:{
        selectedInventory(inventory){
            EventBus.$emit('selected-inventory',inventory);
        }
    }
};
</script>
