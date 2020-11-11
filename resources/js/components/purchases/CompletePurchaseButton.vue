<template>
    <button
        class="rounded px-4 py-2 bg-teal-600 hover:bg-teal-400 text-white font-bold mr-4"
        @click="completePurchase"
    >
        <i class="far fa-check-circle"></i>
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
                    EventBus.$emit('purchase-completed',res.data.data)
                    console.log('status ' + res.data.data.status)
                    if(res.data.data.status === 'COMPLETADA'){
                        localStorage.removeItem('productsInPurchase')
                    }
                })
                .catch(err => {
                    console.log(err);
                });
        }
    }
};
</script>
