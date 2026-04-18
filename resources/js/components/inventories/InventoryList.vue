<template>
    <ul class="bg-white  px-6 flex flex-wrap justify-center py-2 gap-2 w-full text-center  shadow-sm">
        <li v-for="(inventory, index) in inventories" :key="inventory.id" @click="selectedInventory(index, inventory)"
            class="border border-gray-300 rounded-sm "
            :class="{ 'bg-[#4D4D4D] text-gray-100': selectedIndex === index }">
            <a href="#" class="block p-2 rounded-sm  hover:bg-[#4D4D4D] hover:text-gray-100 uppercase font-normal "
                @click.prevent="">{{
                    inventory.name
                }}</a>
        </li>
    </ul>
</template>

<script>
export default {
    data() {
        return {
            inventories: [],
            selectedIndex: null
        };
    },
    mounted() {
        axios
            .get("/inventories")
            .then(res => {
                this.inventories = res.data.data;
            })
            .catch(err => {
                console.log(err);
            });
    },
    methods: {
        selectedInventory(index, inventory) {
            this.selectedIndex = index;

            sessionStorage.setItem("inventory_id", inventory.id);

            EventBus.$emit("selected-inventory", inventory);
        }
    }
};
</script>
