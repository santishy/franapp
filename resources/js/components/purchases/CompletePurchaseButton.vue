<template>
    <button
        class="mr-4 text-white p-1 text-2xl bg-teal-600 rounded-full hover:bg-teal-400"
        @click="completePurchase"
    >
        <check-icon/>
    </button>
</template>
<script>
import { mapMutations } from "vuex";
import CheckIcon from "../icons/CheckIcon.vue";
export default {
    components: { CheckIcon},
    props: {
        purchase: {
            type: Object,
        },
        totalPurchase: {
            type: Number,
        },
    },
    data: () => {
        return {
            inventory_id: null,
        };
    },
    mounted() {
        EventBus.$on("selected-inventory", (id) => {
            this.inventory_id = id;
        });
    },
    methods: {
        ...mapMutations(["setErrors"]),
        completePurchase() {
            axios
                .put(`/purchases/${this.purchase.id}`, {
                    status: "completed",
                    total: this.totalPurchase,
                    _method: "put",
                    inventory_id: this.inventory_id
                        ? this.inventory_id
                        : this.user.inventory_id,
                })
                .then((res) => {
                    EventBus.$emit("purchase-completed", res.data.data);
                    if (res.data.data.status === "COMPLETADA") {
                        localStorage.removeItem("productsInPurchase");
                    }
                })
                .catch((err) => {
                    this.setErrors(err);
                    //this.getErrors(err);
                });
        },
    },
};
</script>
