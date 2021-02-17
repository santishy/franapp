<template>
    <div class="rounded overflow-hidden shadow-lg bg-white">
        <div class=" p-2 border-b-2 border-teal-400">
            <p>SKU</p>
            <p>{{ localProduct.sku }}</p>
        </div>
        <div class=" p-2 border-b-2 border-teal-400">
            <p>Precio de compra</p>
            <input
                type="number"
                v-model="localProduct.pivot.purchase_price"
                class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
            />
        </div>
        <div class=" p-2 border-b-2 border-teal-400">
            <p>Cantidad</p>
            <input
                type="number"
                v-model="localProduct.pivot.qty"
                class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
            />
        </div>
        <div class=" p-2 border-b-2 border-teal-400 flex justify-center">
            <button
                @click="update"
                class="bg-blue-500 rounded px-2 py-0 text-center hover:bg-blue-400 mr-4"
            >
                <i class="far fa-edit"></i>
            </button>
            <button
                @click="destroy"
                class="bg-red-500 hover:bg-red-400 p-2 rounded "
            >
                <i class="fas fa-minus-circle"></i>
            </button>
        </div>
    </div>
</template>
<script>
import {mapMutations,mapGetters} from 'vuex';
export default {
    props: {
        product: {
            type: Object
        },
        index: {
            type: Number
        }
    },
    data() {
        return {
            localProduct: this.product
        };
    },
    methods: {
        ...mapMutations(['setProductsInPurchase','deleteProductInPurchase']),
        update() {
            axios
                .post(`/products-in-purchases/${this.localProduct.id}`, {
                    ...this.localProduct,
                    ...{ _method: "put" }
                })
                .then(res => {
                    if (res.data.totalPurchase) {
                        EventBus.$emit(
                            "total-updated-purchase",
                            res.data.totalPurchase
                        );
                        var obj = new Object();
                        obj.hasProductsInPurchase = this.hasProductsInPurchase;

                        obj.index = this.productExistsInPurchase(
                            this.localProduct.id
                        );

                        obj.productInPurchase = {
                            qty: this.localProduct.pivot.qty,
                            product_id: this.localProduct.id
                        };
                        this.setProductsInPurchase(obj);
                    }
                })
                .catch(res => {
                    console.log(res);
                });
        },
        destroy() {
            axios
                .delete(`/products-in-purchases/${this.localProduct.id}`)
                .then(res => {
                    if (res.data) {
                        this.deleteProductInPurchase(this.index);
                        EventBus.$emit("purchase-extracted", this.index);
                        EventBus.$emit("total-updated-purchase",this.data.totalPurchase)
                    }
                })
                .catch(res => {
                    console.log(res);
                });
        }
    },
    computed:{
        ...mapGetters(['hasProductsInPurchase','productExistsInPurchase'])
    }
};
</script>
