<template>
    <div can="'create sale'">
        <form class="block" @submit.prevent="submit">
            <input type="hidden" name="product_id" />
            <button
                class="
                    rounded-full
                    hover:text-gray-800
                    shadow-xs
                    text-gray-600
                    font-bold
                    py-2
                    bg-white
                    px-2
                    text-2xl
                "
            >
                <shopping-cart-icon></shopping-cart-icon>
            </button>
        </form>
    </div>
</template>
<script>
import { mapState } from "vuex";
import Errors from "../../mixins/Errors";
import Transaction from "../../mixins/Transaction.js";
import ShoppingCartIcon from "../icons/ShoppingCartIcon.vue";
export default {
    components: { ShoppingCartIcon },
    props: {
        product: {
            type: Object,
            required:true
        },
        index: {
            type: Number,
        },
    },

    mixins: [Transaction, Errors],
    methods: {
        submit() {
            const inventory_id = this.isAdmin
                ? sessionStorage.getItem("inventory_id")
                : this.user.inventory_id;
            axios
                .post(`/sales/${this.product.id}/products`, {
                    salePriceOption: this.salePriceOption,
                    inventory_id,
                })
                .then((res) => {
                    EventBus.$emit(
                        "product-added-sales-cart",
                        res.data.transaction
                    );
                    this.addProductToTranscation();
                })
                .catch((err) => {
                    this.getErrors(err);
                    this.$notify({
                        group: "foo",
                        title: "Error",
                        type: "error",
                        text: this.errors[0],
                    });
                });
        },
    },
    computed: {
        ...mapState(["salePriceOption"]),
    },
};
</script>
