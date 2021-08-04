<template>
    <form @submit.prevent="submit">
        <button
            type="submit"
            class="text-xs transition-all rounded border-2 border-orange-800 text-orange-700 p-1 hover:bg-orange-800 hover:text-white"
        >
            <i class="fas fa-warehouse"></i>
            Vaciar almacén
        </button>
    </form>
</template>

<script>
export default {
    props: {
        warehouse: {
            type: Object
        }
    },
    methods: {
        submit() {
            axios
                .delete("/inventories/" + this.warehouse.id, {
                    id: this.warehouse.id
                })
                .then(res => {
                    console.log(res);
                });
        }
    }
};
</script>
