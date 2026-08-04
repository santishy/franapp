<template>
    <button @click="action"
        class="transition-all rounded border-2 border-red-800 text-red-700 p-1 hover:bg-red-800 hover:text-white">
        Aceptar
    </button>
</template>
<script>

export default {
    emits: [
        "cancelTransaction",
        "deleteWarehouse",
        "emptyWarehouse",
        "deleteProduct",
    ],
    props: {
        method: {
            type: String
        },
    },
    methods: {
        action() {
            this.$emit(this.method)
        }
    },
}
</script>
