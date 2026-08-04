<template>
    <button
        class="mr-4 text-white disabled:opacity-50 disabled:cursor-not-allowed p-1 text-2xl bg-teal-600 rounded-full hover:bg-teal-400"
        :disabled="disabled" @click="completePurchase">
        <check-icon />
    </button>
</template>
<script>
import { mapMutations } from "vuex";
import CheckIcon from "../icons/CheckIcon.vue";
export default {
    components: { CheckIcon },
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
            disabled: false,
        };
    },
    mounted() {
        EventBus.$on("selected-inventory", this.setInventoryId);
    },
    beforeUnmount() {
        EventBus.$off("selected-inventory", this.setInventoryId);
    },
    methods: {
        ...mapMutations(["setErrors"]),
        setInventoryId(id) {
            this.inventory_id = id;
        },
        completePurchase() {
            this.disabled = true;
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
                        this.disabled = true;
                    }
                })
                .catch((err) => {
                    this.setErrors(err);
                    this.disabled = false;
                    //this.getErrors(err);
                });
        },
    },
};
</script>
