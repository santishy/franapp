<template>
    <button
        class="px-4 py-1 mr-4 text-white bg-teal-600 rounded hover:bg-teal-400"
        @click="completePurchase"
    >
        <i class="far fa-check-circle"></i> Completar compra
    </button>
</template>
<script>
import {mapMutations} from "vuex"
export default {
    
    props: {
        purchase: {
            type: Object
        },
        totalPurchase: {
            type: Number
        }
    },
    data: () => {
        return {
            inventory_id: null
        };
    },
    mounted() {
        EventBus.$on("selected-inventory", id => {
            this.inventory_id = id;
        });
    },
    methods: {
        ...mapMutations(['setErrors']),
        completePurchase() {
            axios
                .put(`/purchases/${this.purchase.id}`, {
                    status: "completed",
                    total: this.totalPurchase,
                    _method: "put",
                    inventory_id: this.inventory_id ? this.inventory_id : this.user.inventory_id,
                })
                .then(res => {
                    EventBus.$emit("purchase-completed", res.data.data);
                    if (res.data.data.status === "COMPLETADA") {
                        localStorage.removeItem("productsInPurchase");
                    }
                })
                .catch(err => {
                    this.setErrors(err);
                    //this.getErrors(err);
                });
        }
    }
};
</script>
