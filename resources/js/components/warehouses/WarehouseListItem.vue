<template>
    <tr>
        <td class="border px-4 py-2">{{ inventory.name }}</td>
        <td class="border px-4 py-2">{{ inventory.address }}</td>
        <td class="border px-4 py-2 flex flex-wrap">
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
export default {
    props: {
        inventory: {
            type: Object
        }
    },
    components: {
        EmptyWarehouse,
        DeleteWarehouse
    }
};
</script>
