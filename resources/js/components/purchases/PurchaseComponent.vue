<template>
    <div class="grid md:grid-cols-5 md:grid-rows-2 gap-4 ">
        <div class="col-span-2 row-span-1  bg-white rounded px-2 py-4">
            <h3 class="text-2xl font-semibold text-center py-2 px-2 mb-4">
                Compra Actual
            </h3>
            <div class="grid md:grid-cols-1 text-center">
                <p class="text-xl text-gray-800 mb-2">
                    <span>Total Compra:</span> ${{
                        new Intl.NumberFormat("es-MX").format(
                            localTotalPurchase
                        )
                    }}
                </p>
                <p class="text-xl text-gray-800 mb-4">
                    <span>Status:</span> {{ translateStatus }}
                </p>
                <div class="w-full">
                    <complete-purchase-btn
                        :purchase="purchase"
                        :total-purchase="localTotalPurchase"
                    />
                    <cancel-purchase-btn :id="purchase.id" />
                </div>
            </div>
        </div>
        <product-in-purchase
            v-for="(product, index) in localProductsInPurchase"
            :product="product"
            :index="index"
            :key="product.id"
        />
    </div>
</template>
<script>
import CompletePurchaseButton from "./CompletePurchaseButton.vue";
import CancelPurchaseButton from "./CancelPurchaseButton";
export default {
    components: {
        "complete-purchase-btn": CompletePurchaseButton,
        "cancel-purchase-btn": CancelPurchaseButton
    },
    props: {
        productsInPurchase: {
            type: Array
        },
        totalPurchase: {
            type: Number
        },
        purchase: {
            type: Object
        }
    },
    data() {
        return {
            localProductsInPurchase: this.productsInPurchase,
            localTotalPurchase: this.totalPurchase,
            localPurchase: this.purchase
        };
    },
    mounted() {
        EventBus.$on("purchase-extracted", this.removeProductFromPurchase);
        EventBus.$on("total-updated-purchase", this.changeTotal);
        EventBus.$on("purchase-completed", purchase => {
            this.localPurchase.status = purchase.status;
        });
    },

    methods: {
        removeProductFromPurchase(index) {
            this.localProductsInPurchase.splice(index, 1);
        },
        changeTotal(newTotalPurchase) {
            this.localTotalPurchase = newTotalPurchase;
        }
    },
    computed: {
        translateStatus() {
            if (this.localPurchase.status === "pending") return "Pendiente";
            return "Completado";
        }
    }
};
</script>
