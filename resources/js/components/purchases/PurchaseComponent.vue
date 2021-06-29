<template>
    <nav-component>
        <div class="grid md:grid-cols-5 md:grid-rows-2 gap-4 mt-24 md:mt-32">
            <div
                class="bg-gray-700 text-white shadow-sm border-none rounded-sm p-4"
            >
                <h3 class="text-xl mb-2 text-center">Elige un almacén</h3>
                <label
                    v-for="inventory in inventories"
                    class="block text-center "
                    :key="inventory.id"
                    @click="selectedInventory(inventory)"
                >
                    <span>{{ inventory.name }}</span>
                    <input
                        type="radio"
                        name="inventory_id"
                        :value="inventory.id"
                    />
                </label>
            </div>
            <div
                class="col-span-2 row-span-1  bg-white rounded px-2 py-2  shadow border-gray-400 border"
            >
                <h3 class="text-2xl font-semibold text-center py-2 px-2 mb-2">
                    Compra Actual
                </h3>
                <div class="grid md:grid-cols-1 text-center">
                    <p class="text-xl text-gray-800 mb-2">
                        <span class="text-2xl">Total Compra:</span>
                        <span class="text-2xl font-semibold"
                            >${{
                                new Intl.NumberFormat("es-MX").format(
                                    localTotalPurchase
                                )
                            }}</span
                        >
                    </p>
                    <p class="text-xl text-gray-800 mb-4">
                        <span class="text-2x text-gray-600">Status:</span>
                        <span class="text-2x text-blue-600 font-semibold">{{
                            translateStatus
                        }}</span>
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
    </nav-component>
</template>
<script>
import CompletePurchaseButton from "./CompletePurchaseButton.vue";
import CancelPurchaseButton from "./CancelPurchaseButton";
import NavComponent from "../NavComponent.vue";
export default {
    components: {
        "complete-purchase-btn": CompletePurchaseButton,
        "cancel-purchase-btn": CancelPurchaseButton,
        NavComponent
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
        },
        inventories: {
            type: Array
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
        },
        selectedInventory(inventory) {
            EventBus.$emit("selected-inventory", inventory.id);
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
