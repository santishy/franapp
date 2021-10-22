<template>
    <div>
        <label class="inline-flex items-center mt-3" v-for="warehouse in warehouses"
                :key="warehouse.id">
            <input
                
                type="checkbox"
                @change="toggleWarehouse(warehouse, $event)"
                class="form-checkbox h-5 w-5 text-teal-600"
            /><span class="ml-2 text-gray-700">{{ warehouse.name }}</span>
        </label>
    </div>
</template>
<script>
export default {
    props: {
        warehouses: { type: Array }
    },
    data() {
        return {
            selectedWarehouse: []
        };
    },
    methods: {
        toggleWarehouse(warehouse, event) 
        {
            if (!event.target.checked) {
                if (this.selectedWarehouse.includes(warehouse.id)) {
                    const index = this.selectedWarehouse.indexOf(
                        warehouse.id
                    );
                    this.selectedWarehouse.splice(index, 1);
                    return;
                }
            }
            this.selectedWarehouse.push(warehouse.id);
        }
    }
};
</script>
