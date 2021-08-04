<template>
    <form @submit.prevent="submit">
        <button type="submit">
            <button
        class="transition-all rounded border-2 border-red-800 text-red-700 p-1 hover:bg-red-800 hover:text-white"
        @click.prevent="destroy"
    >
        <i class="fas fa-trash"></i> Eliminar almacen
    </button>
        </button>
    </form>
</template>
<script>

export default {
    props:{
        inventory:{
            type:Object,
        }
    },
    methods: {
        submit() {
            axios.delete('/warehouses/'+inventory.id)
                .then(res => {
                    console.log(res)
                })
        }
    }
}
</script>
