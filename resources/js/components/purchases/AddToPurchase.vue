<template>
    <form @submit.prevent="submit">
        <input type="hidden" name="product_id" />
        <button
            class="bg-purple-500 border-purple-900 border-b-4 hover:bg-purple-700 text-white font-bold py-1 px-4 rounded-full text-2xl"
        >
            C
            <div v-if="getPurchaseAmount" class="inline-block">
                <i class="fas fa-arrow-right"></i>
                <span>{{ getPurchaseAmount }}</span>
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
            productsInPurchase: [],
            qty: null
        };
    },
    mounted() {
        console.log(this.getPurchaseAmount);
    },

    methods: {
        submit() {
            axios
                .post("/purchases", {
                    product_id: this.product_id,
                    purchase_price: this.purchase_price
                })
                .then(res => {
                    if (
                        this.hasProductsInPurchase
                    ) {
                        this.productsInPurchase = JSON.parse(
                            localStorage.getItem("productsInPurchase")
                        );
                        var index = JSON.parse(
                            localStorage.getItem("productsInPurchase")
                        ).findIndex(
                            product => product.product_id == this.product_id
                        );
                       
                    }
                     if (index != -1)
                            this.productsInPurchase[index].qty = res.data;
                        else
                            this.productsInPurchase.push({
                                product_id: this.product_id,
                                qty: res.data
                            });
                    localStorage.setItem(
                        "productsInPurchase",
                        JSON.stringify(this.productsInPurchase)
                    );
                    console.log(res.data + ' cantidad')
                    Vue.set(this.$data,'qty',res.data);
                })
                .catch(err => {
                    console.log(err);
                });
        }
    },
    computed: {
        ...mapGetters(['hasProductsInPurchase']),
        getPurchaseAmount() {
            if (!(localStorage.getItem("productsInPurchase") === null)) {
                var index = JSON.parse(
                    localStorage.getItem("productsInPurchase")
                ).findIndex(product => product.product_id === this.product_id);
                if (index != -1){
                    this.qty = JSON.parse(
                        localStorage.getItem("productsInPurchase")
                    )[index].qty;
                    console.log('hi')
                    return this.qty
                }
                    
            }
            return null;
        }
    }
};
</script>
