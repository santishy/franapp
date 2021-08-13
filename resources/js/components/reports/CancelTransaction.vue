<template>
    <form @submit.prevent="submit">
        <button
            type="submit"
            class="transition-all text-xs rounded border-2 border-red-800 px-2 text-red-700 hover:bg-red-800 hover:text-white"
        >
            <i class="fas fa-ban"></i> Cancelar
        </button>
    </form>
</template>
<script>
export default {
    props: {
        uri: {
            type: String
        },
        transaction: { type: Object }
    },
    mounted(){
        console.log(this.transaction)
    },
    methods: {
        submit() {
            axios
                .delete(this.uri+'/'+this.transaction.id, {
                    params: { factor: -1, inventory_id: this.transaction.inventory_id }
                })
                .then(res => {
                    console.log(res.data);
                });
        }
    }
};
</script>
