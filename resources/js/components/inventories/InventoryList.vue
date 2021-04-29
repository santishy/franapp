<template>
    <ul class="bg-white shadow-sm runded w-full text-center">
        <li v-for="inventory in inventories" :key="inventory.id">
            <a
                href="#"
                class="block p-4"
                @click="selectedInventory(inventory)"
                >{{ inventory.name }}</a
            >
        </li>
    </ul>
</template>

<script>
export default {
    data() {
        return {
            inventories: []
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
        selectedInventory(inventory) {
            EventBus.$emit("selected-inventory", inventory);
        }
    }
};
</script>
