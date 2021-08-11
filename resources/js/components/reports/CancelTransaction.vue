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
        trasanction: { type: Object }
    },
    methods: {
        submit() {
            axios.delete(this.uri, { params: { factor: -1 } }).then(res => {
                
            });
        }
    }
};
</script>
