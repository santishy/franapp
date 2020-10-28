<template>
    <form @submit.prevent="submit">
        <input type="hidden" name="product_id" />
        <button
            class="bg-purple-500 border-purple-900 border-b-4 hover:bg-purple-700 text-white font-bold py-1 px-4 rounded text-2xl"
        >
            C
            <div v-if="qtyPurchase(productExistsInPurchase(product_id))" class="inline-block">
                <span class="bg-purple-900 rounded-full py-0 px-2 text-xl">{{ qtyPurchase(productExistsInPurchase(product_id)) }}</span>
            </div>
        </button>
    </form>
</template>
<script>
import { mapGetters, mapMutations } from "vuex";
export default {
    props: {
        product_id: {
            type: Number
        },
        purchase_price: {
            type: Number
        }
    },
    mounted(){
        console.log(this.productExistsInPurchase(this.product_id))
    },
    methods: {
        ...mapMutations(['setProductsInPurchase']),
        submit(e) {
            e.target.disabled=true;
            axios
                .post("/purchases", {
                    product_id: this.product_id,
                    purchase_price: this.purchase_price
                })
                .then(res => {
                    var obj = new Object();
                    obj.hasProductsInPurchase = this.hasProductsInPurchase;
                   
                    obj.index = this.productExistsInPurchase(this.product_id)
    
                    obj.productInPurchase = { qty: res.data,product_id:this.product_id };
                    this.setProductsInPurchase(obj);
                })
                .catch(err => {
                    console.log(err);
                });
        }
    },
    computed: {
        ...mapGetters(["hasProductsInPurchase", "productExistsInPurchase","qtyPurchase"]),
        }
    }

</script>
