<template>
    <button
        class="rounded px-2 py-4 bg-teal-400 hover:bg-teal-600 text-white font-bold"
        @click="completePurchase"
    >
        Completar
    </button>
</template>
<script>
export default {
    props: {
        purchase: {
            type: Object
        },
        totalPurchase: {
            type: Number
        }
    },
    methods: {
        completePurchase() {
            axios
                .post(`/purchases/${this.purchase.id}`, {
                    status: "completed",
                    total: this.totalPurchase,
                    _method:"PUT"
                })
                .then(res => {
                    console.log(res);
                })
                .catch(err => {
                    console.log(err);
                });
        }
    }
};
</script>
