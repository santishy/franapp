<template>
    <tr>
        <td class="border px-4 py-2">{{ inventory.name }}</td>
        <td class="border px-4 py-2">{{ inventory.address }}</td>
        <td class="border px-4 py-2 flex flex-wrap justify-center">
            <edit-warehouse :inventory="inventory" class="mr-2"></edit-warehouse>
            <empty-warehouse
                :warehouse="inventory"
                class="mr-2"
            ></empty-warehouse>
            <delete-warehouse :inventory="inventory"></delete-warehouse>
        </td>
    </tr>
</template>
<script>
import DeleteWarehouse from "./DeleteWarehouse.vue";
import EmptyWarehouse from "./EmptyWarehouse.vue";
import EditWarehouse from "./EditWarehouse.vue";
export default {
    props: {
        inventory: {
            type: Object
        }
    },
    components: {
        EmptyWarehouse,
        DeleteWarehouse,
        EditWarehouse,
    }
};
</script>
