<template>
    <form @submit.prevent="submit">
        <button
            class="text-xs transition-all rounded border-2 border-red-800 text-red-700 p-1 hover:bg-red-800 hover:text-white"
            type='submit'
        >
            <i class="fas fa-trash"></i> Eliminar almacen
        </button>
    </form>
</template>
<script>
export default {
    props: {
        inventory: {
            type: Object
        }
    },
    methods: {
        submit() {
            EventBus.on('open-modal',true);
            
            axios.delete("/warehouses/" + this.inventory.id).then(res => {
                console.log(res);
            });
        }
    }
};
</script>
