<template>
    <tr
        class="
            bg-white
            border-b border-gray-400
            md:border-none
            block
            md:table-row
        "
    >
        <td
            class="
                p-2
                md:border md:border-grey-500
                text-left
                block
                md:table-cell
            "
        >
            <span class="inline-block w-1/3 md:hidden font-bold">SKU</span>
            <div class="font-semibold text-gray-800 inline-block">
                {{ localProduct.sku }}
            </div>
        </td>
        <td
            class="
                p-2
                md:border md:border-grey-500
                text-left
                block
                md:table-cell
            "
        >
            <span class="inline-block w-1/3 md:hidden font-bold"
                >Categoría</span
            >
            {{ localProduct.category_name }}
        </td>
        <td
            class="
                p-2
                md:border md:border-grey-500
                text-left
                block
                md:table-cell
            "
        >
            <span class="inline-block w-1/3 md:hidden font-bold"
                >Descripción</span
            >
            {{ localProduct.description }}
        </td>
        <td
            class="
                p-2
                md:border md:border-grey-500
                text-left
                block
                md:table-cell
            "
        >
            <span class="inline-block w-full md:hidden font-bold"
                >Precio de compra</span
            >
            <input
                type="number"
                v-model="localProduct.purchase_price"
                class="
                    appearance-none
                    bg-transparent
                    border-none
                    w-full
                    text-center
                    bg-gray-300
                    text-gray-700
                    mr-3
                    py-1
                    px-2
                    leading-tight
                    focus:outline-none
                    shadow-inner
                "
            />
        </td>
        <td
            class="
                p-2
                md:border md:border-grey-500
                text-left
                block
                md:table-cell
            "
        >
            <span class="inline-block w-full md:hidden font-bold"
                >Cantidad</span
            >
            <input
                type="number"
                v-model="localProduct.purchase_quantity"
                class="
                    appearance-none
                    bg-transparent
                    border-none
                    sm:w-full
                    w-full
                    text-center
                    bg-gray-300
                    text-gray-700
                    mr-3
                    py-1
                    px-2
                    leading-tight
                    focus:outline-none
                    shadow-inner
                "
            />
        </td>
        <td
            class="
                p-2
                md:border md:border-grey-500
                text-left
                block
                md:table-cell
            "
        >
            <span class="inline-block w-1/3 md:hidden font-bold">Total</span>
            {{ getTotal }}
        </td>
        <td
            class="
                p-2
                md:border md:border-grey-500
                text-left
                block
                md:table-cell
            "
        >
            <span class="inline-block w-1/3 md:hidden font-bold">Acciones</span>
            <div class="flex flex-wrap inline-block">
                <button
                    @click="update"
                    class="
                        bg-blue-500
                        rounded
                        p-0
                        px-2
                        text-center
                        hover:bg-blue-400
                        mr-1
                    "
                >
                    <edit-icon></edit-icon>
                </button>
                <button
                    @click="destroy"
                    class="bg-red-500 hover:bg-red-400 p-0 px-2 rounded"
                >
                    <trash-icon></trash-icon>
                </button>
            </div>
        </td>
    </tr>
    <!-- <div class="rounded overflow-hidden shadow-lg bg-white text-center">
        <div class=" p-2 border-b-2 border-teal-400">
            <p class="font-semibold">SKU</p>
            <p>{{ localProduct.sku }}</p>
        </div>
        <div class=" px-2 border-b-2 border-teal-400">
            <p class="font-semibold">Precio de compra</p>
            <input
                type="number"
                v-model="localProduct.pivot.purchase_price"
                class="appearance-none bg-transparent border-none w-full text-center bg-gray-300 text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
            />
        </div>
        <div class=" p-2 border-b-2 border-teal-400">
            <p class="font-semibold">Cantidad</p>
            <input
                type="number"
                v-model="localProduct.pivot.qty"
                class="appearance-none bg-transparent border-none w-full text-center bg-gray-300 text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
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
    </div> -->
</template>
<script>
import { mapMutations, mapGetters } from "vuex";
import EditIcon from "../icons/EditIcon.vue";
import TrashIcon from "../icons/TrashIcon.vue";
export default {
    components: { TrashIcon, EditIcon },
    props: {
        product: {
            type: Object,
        },
        index: {
            type: Number,
        },
    },
    data() {
        return {
            localProduct: this.product,
        };
    },
    methods: {
        ...mapMutations(["setProductsInPurchase", "deleteProductInPurchase"]),
        update() {
            axios
                .post(`/products-in-purchases/${this.localProduct.id}`, {
                    ...this.localProduct,
                    ...{ _method: "put" },
                })
                .then((res) => {
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
                            qty: this.localProduct.purchase_quantity,
                            product_id: this.localProduct.id,
                        };
                        this.setProductsInPurchase(obj);
                    }
                })
                .catch((err) => {
                    this.getErrors(err);
                });
        },
        destroy() {
            axios
                .delete(`/products-in-purchases/${this.localProduct.id}`)
                .then((res) => {
                    if (res.data) {
                        let index = this.productExistsInPurchase(
                            this.localProduct.id
                        );

                        this.deleteProductInPurchase(index);
                        EventBus.$emit("purchase-extracted", this.index);
                        EventBus.$emit(
                            "total-updated-purchase",
                            res.data.totalPurchase
                        );
                    }
                })
                .catch((err) => {
                    this.getErrors(err);
                });
        },
    },
    computed: {
        ...mapGetters(["hasProductsInPurchase", "productExistsInPurchase"]),
        getTotal() {
            return (
                this.localProduct.purchase_price *
                this.localProduct.purchase_quantity
            );
        },
    },
};
</script>
