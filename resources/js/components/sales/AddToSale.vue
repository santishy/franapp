<template>
    <div>
        <form class="block" @submit.prevent="submit">
            <input type="hidden" name="product_id" />
            <button
                class="bg-purple-500  w-full hover:bg-purple-700 text-white font-bold py-1 px-4 rounded text-2xl"
            >
                <i class="fas fa-shopping-cart"></i>
            </button>
        </form>
        <notifications group="foo" position="botton right"></notifications>
    </div>
</template>
<script>
import { mapState } from "vuex";
import Errors from "../../mixins/Errors";
import Transaction from "../../mixins/Transaction";
export default {
    props: {
        product: {
            type: Object
        },
        index: {
            type: Number
        }
    },
    mixins: [Errors,Transaction],
    methods: {
        submit() {
            axios
                .post(`/sales/${this.product.id}/products`, {
                    salePriceOption: this.salePriceOption
                })
                .then(res => {
                    EventBus.$emit(
                        "product-added-sales-cart",
                        res.data.transaction
                    );
                    this.addProductToTransaction();
                })
                .catch(err => {
                    console.log("hola");
                    this.getErrors(err);
                    this.$notify({
                        group: "foo",
                        title: "Error",
                        type: "error",
                        text: this.errors[0]
                    });
                });
        }
    },
    computed: {
        ...mapState(["salePriceOption"])
    }
};
</script>
