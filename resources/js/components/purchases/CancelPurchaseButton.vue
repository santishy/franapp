<template>
    <button
        class="rounded px-4 py-2 bg-red-600 hover:bg-red-400 text-white font-bold"
        @click="cancelPurchase"
    >
        <i class="far fa-times-circle"></i>
    </button>
</template>
<script>
export default {
    props: {
        id: {
            type: Number
        }
    },
    methods: {
        cancelPurchase() {
            axios
                .delete("/purchases/" + this.id)
                .then(res => {
                    if (res.data.delete) {
                        localStorage.removeItem('productsInPurchase');
                        window.location.replace("/products");
                    }
                })
                .catch(err => {
                    console.log(err);
                });
        }
    }
};
</script>
