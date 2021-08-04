<template>
    <a
        :href="`/warehouses/${inventory.id}/edit`"
        class="text-xs transition-all rounded border-2 border-blue-800 text-blue-700 p-1 hover:bg-blue-800 hover:text-white"
    >
        <i class="fas fa-edit"></i> Editar almacén
    </a>
</template>
<script>
export default {
    props: {
        inventory: {
            type: Object
        }
    },
};
</script>
