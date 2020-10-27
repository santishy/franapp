<template>
    <form @submit.prevent="submit">
        <input type="hidden" name="product_id" />
        <button
            class="bg-purple-500 border-purple-900 border-b-4 hover:bg-purple-700 text-white font-bold py-1 px-4 rounded-full text-2xl"
        >
            C
            <div v-if="getPurchaseAmount" class="inline-block">
                <i class="fas fa-arrow-right"></i>
                <span>{{ getNumberOfProductsInPurchase }}</span>
            </div>
        </button>
    </form>
</template>
<script>
import { mapGetters } from "vuex";
export default {
    props: {
        product_id: {
            type: Number
        },
        purchase_price: {
            type: Number
        }
    },
    data() {
        return {
            productsInPurchase: []
        };
    },
    mounted(){
        console.log(localStorage.getItem("productsInPurchase"))
    },

    methods: {
        submit() {
            axios
                .post("/purchases", {
                    product_id: this.product_id,
                    purchase_price: this.purchase_price
                })
                .then(res => {
                    if (!(localStorage.getItem("productsInPurchase") === null)) {
                        this.productsInPurchase = localStorage.getItem(
                            "productsInPurchase"
                        );
                    }
                    this.productsInPurchase.push(
                        ...[{ product_id: this.product_id, qty: res.data }]
                    );
                    localStorage.setItem(
                        "productsInPurchase",
                        JSON.stringify(this.productsInPurchase)
                    );
                })
                .catch(err => {
                    console.log(err);
                });
        }
    },
    computed: {
        ...mapGetters(["getNumberOfProductsInPurchase"]),
        getPurchaseAmount() {
            if (!(localStorage.getItem("productsInPurchase") === null)) {
                var product = JSON.parse(localStorage
                    .getItem("productsInPurchase"))
                    .find(product => product.product_id === this.product_id);
                var index = JSON.parse(localStorage
                    .getItem("productsInPurchase"))
                    .indexOf(product);
                return JSON.parse(localStorage.getItem("productsInPurchase"))[index].qty;
            }
            return null;
        }
    }
};
</script>
