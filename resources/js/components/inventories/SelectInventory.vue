<template>
    <layout-component>
        <div class="px-4">
            <div class="bg-white rounded w-full flex items-center justify-center flex-col px-2 py-4 ">
                <h1 class="text-lg font-bold text-center">Selecciona un inventario</h1>
                <ul class="md:w-4/12 w-4/5 rounded   mt-4 divide-y divide-white">
                    <li v-for="inventory in inventories" :key="inventory.id">
                        <button class="block w-full bg-sky-500 hover:bg-sky-600 text-white font-bold py-2 px-4 rounded "
                            @click="selectInventory(inventory.id)">{{ inventory.name }}</button>
                    </li>
                </ul>
            </div>
        </div>
    </layout-component>
</template>

<script>
export default {
    created() {

    },
    props: {
        inventories: {
            type: Array,
            required: true
        }
    },
    components: {},
    data() {
        return {

        };
    },
    methods: {
        async selectInventory(inventoryId) {
            try {
                const resp = await axios.post('/select-inventory', { inventory_id: inventoryId });
                if (resp.status === 200) {
                    window.location.href = '/'
                }
            } catch (error) {
                console.log(error)
            }
        }
    }
};
</script>