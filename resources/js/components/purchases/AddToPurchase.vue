<template>
    <form @submit.prevent="submit">
        <input type="hidden" name="product_id" />
        <button
            class="bg-purple-500 border-purple-900 border-b-4 hover:bg-purple-700 text-white font-bold py-1 px-4 rounded-full text-2xl"
        >
            C
            <div v-if="qtyPurchase(productExistsInPurchase(product_id))" class="inline-block">
                <i class="fas fa-arrow-right"></i>
                <span>{{ qtyPurchase(productExistsInPurchase(product_id)) }}</span>
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
        submit() {
            axios
                .post("/purchases", {
                    product_id: this.product_id,
                    purchase_price: this.purchase_price
                })
                .then(res => {
                    var obj = new Object();
                    obj.hasProductsInPurchase = this.hasProductsInPurchase;
                    console.log('esto es  obj.hasProductsInPurchase '+ obj.hasProductsInPurchase)
                    obj.index = this.productExistsInPurchase(this.product_id);
                    console.log('index'+obj.index)
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
        // getPurchaseAmount() {
        //     if (!(localStorage.getItem("productsInPurchase") === null)) {
        //         var index = JSON.parse(
        //             localStorage.getItem("productsInPurchase")
        //         ).findIndex(product => product.product_id === this.product_id);
        //         if (index != -1) {
        //             this.qty = JSON.parse(
        //                 localStorage.getItem("productsInPurchase")
        //             )[index].qty;
        //             console.log("hi");
        //             return this.qty;
        //         }
        //     }
        //     return null;
        }
    }

</script>
