<template>
    <layout-component>
        <div class="grid w-full grid-flow-row px-4 mx-auto md:grid-cols-5">
            <div
                class="
                    flex flex-col
                    md:items-center
                    items-start
                    md:justify-around
                    col-span-5
                    row-span-1
                    px-2
                    py-2
                    bg-white
                    sm:flex-row
                "
            >
                <div class="md:ml-4 ml-0 text-xl text-gray-800">
                    <span class="text-gray-600 text-2x">Status:</span>
                    <span class="font-semibold text-blue-600 text-2x">{{
                        translateStatus
                    }}</span>
                </div>
                <div class="mt-2 md:mt-0">
                    <complete-purchase-btn
                        :purchase="purchase"
                        :total-purchase="localTotalPurchase"
                    />
                    <cancel-purchase-btn :purchase="purchase" />
                </div>

                <div class="mr-4 text-xl text-gray-800 mt-2 md:mt-0">
                    <span class="text-2xl">Total Compra:</span>
                    <span class="text-2xl font-semibold"
                        >${{
                            new Intl.NumberFormat("es-MX").format(
                                localTotalPurchase
                            )
                        }}</span
                    >
                </div>
            </div>
            <div class="w-full col-span-5">
                <errors-component
                    :errors-found="errorsFound"
                ></errors-component>
            </div>

            <div
                v-if="isAdmin && !user.inventory_id"
                class="
                    col-span-5
                    px-4
                    py-2
                    text-center text-gray-700
                    bg-white
                "
            >
                <div class="grid grid-cols-1 md:grid-cols-5">
                    <h3 class="col-span-5 mb-2 text-lg text-gray-800 text-left">
                        Elige un almacén
                    </h3>
                    <label
                        v-for="inventory in inventories"
                        class="
                            flex flex-wrap
                            items-center
                            justify-center
                            p-2
                            mb-2
                            mr-2
                            rounded-sm
                            bg-gray-300
                        "
                        :key="inventory.id"
                    >
                        <span class="mr-2">{{ inventory.name }}</span>
                        <input
                            type="radio"
                            name="inventory_id"
                            class="form-radio"
                            @change="selectedInventory(inventory)"
                            :value="inventory.id"
                            :checked="inventory.id == purchase.inventory_id"
                        />
                    </label>
                </div>
            </div>

            <product-list
                v-if="localPurchase.status === 'pending'"
                :products="localProductsInPurchase"
                class="col-span-5 mt-4"
            >
            </product-list>
        </div>
    </layout-component>
</template>
<script>
import CompletePurchaseButton from "./CompletePurchaseButton.vue";
import CancelPurchaseButton from "./CancelPurchaseButton";
import ProductList from "./ProductList.vue";
import { mapState } from "vuex";
export default {
    components: {
        "complete-purchase-btn": CompletePurchaseButton,
        "cancel-purchase-btn": CancelPurchaseButton,
        ProductList,
    },
    props: {
        productsInPurchase: {
            type: Array,
        },
        totalPurchase: {
            type: Number,
        },
        purchase: {
            type: Object,
        },
        inventories: {
            type: Array,
        },
    },
    data() {
        return {
            localProductsInPurchase: this.productsInPurchase,
            localTotalPurchase: this.totalPurchase,
            localPurchase: this.purchase,
        };
    },
    mounted() {
        EventBus.$on("purchase-extracted", this.removeProductFromPurchase);
        EventBus.$on("total-updated-purchase", this.changeTotal);
        EventBus.$on("purchase-completed", (purchase) => {
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
        },
    },
    computed: {
        ...mapState(["errorsFound"]),
        translateStatus() {
            if (this.localPurchase.status === "pending") return "Pendiente";
            return "Completado";
        },
    },
};
</script>
