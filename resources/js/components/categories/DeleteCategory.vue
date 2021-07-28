<template>
    <form @submit.prevent="destroy">
        <button
            type="submit"
            class="transition-all rounded border-2 border-red-800 px-2 text-red-700 hover:bg-red-800 hover:text-white"
        >
            <i class="far fa-trash-alt"></i>
        </button>
    </form>
</template>

<script>
export default {
    props: {
        category: {
            type: Object
        }
    },
    methods: {
        destroy() {
            axios.delete(`/categories/${this.category.id}`).then(res => {
                console.log(res);
            });
        }
    }
};
</script>
