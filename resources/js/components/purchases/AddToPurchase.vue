<template>
    <form @submit.prevent="submit" v-can="'create purchase'">
        <input type="hidden" name="product_id" />
        <button
            class="
                hover:text-gray-800
                shadow-xs
                text-gray-600
                font-bold               
                text-2xl                
                flex flex-wrap justify-center items-center
            "
            :class="[qtyPurchase(productExistsInPurchase(product_id)) ? 'rounded-sm p-1 bg-teal-100' : 'py-2 rounded-full px-2 bg-white']"
        >
            <div
                v-if="qtyPurchase(productExistsInPurchase(product_id))"
                class="inline-block mr-2"
            >
                <span class="text-teal-500 text-xl font-extralight underline decoration-wavy">{{
                    qtyPurchase(productExistsInPurchase(product_id))
                }}</span>
            </div>
            <purchase-icon></purchase-icon>
        </button>
    </form>
</template>
<script>
import { mapGetters, mapMutations } from "vuex";

import PurchaseIcon from "../icons/PurchaseIcon.vue";
export default {
    components: { PurchaseIcon },
    props: {
        product_id: {
            type: Number,
        },
        purchase_price: {
            type: Number,
        },
    },
    data() {
        return {
            purchase_id: null,
        };
    },
    mounted() {
        this.purchase_id = document.head.querySelector(
            'meta[name="purchase_id"]'
        ).content;
    },
    methods: {
        ...mapMutations(["setProductsInPurchase"]),
        submit(e) {
            e.target.disabled = true;
            axios
                .post("/purchases", {
                    product_id: this.product_id,
                    purchase_price: this.purchase_price,
                })
                .then((res) => {
                    var obj = new Object();
                    obj.hasProductsInPurchase = this.hasProductsInPurchase;

                    obj.index = this.productExistsInPurchase(this.product_id);

                    obj.productInPurchase = {
                        qty: res.data.qty,
                        product_id: this.product_id,
                    };
                    if (this.purchase_id == "") {
                        EventBus.$emit(
                            "purchase-created",
                            res.data.purchase_id
                        );
                        document.head.querySelector(
                            'meta[name="purchase_id"]'
                        ).content = res.data.purchase_id;
                    }
                    this.setProductsInPurchase(obj);
                })
                .catch((err) => {
                    this.getErrors(err);
                });
        },
    },
    computed: {
        ...mapGetters([
            "hasProductsInPurchase",
            "productExistsInPurchase",
            "qtyPurchase",
        ]),
    },
};
</script>
