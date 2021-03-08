<template>
    <div class=" rounded overflow-hidden" :class="darkMode">
        <div class="text-justify">
            <div
                class="px-6 pt-4 pb-2 text-center grid grid-cols-4 md:gap-4 gap-1"
            >
                <add-to-purchase
                    :product_id="product.id"
                    :purchase_price="product.distributor_price"
                    :index="index"
                />
                <a
                    :href="`/products/${product.id}/edit`"
                    class="bg-blue-500 inline-block cursor-pointer hover:bg-blue-400 text-white font-bold py-2 px-4 hover:border-blue-500 rounded"
                >
                    <i class="far fa-edit"></i>
                </a>
                <remove-product :product="product" :index="index" />
                <add-to-sale :product="product" :index="index"></add-to-sale>
            </div>
            <div class=" p-2 border-b-2 border-teal-400">
                <p class="text-gray-800 font-bold">SKU</p>
                <p class="text-gray-700 text-base ">
                    {{ product.sku }}
                </p>
            </div>
            <div class=" p-2 border-b-2 border-teal-400">
                <p class="text-gray-800 font-bold">Descripción</p>
                <p class="text-gray-700 text-base ">
                    {{ product.description }}
                </p>
            </div>
            <div class=" p-2 border-b-2 border-teal-400">
                <p class="text-gray-800 font-bold ">Precio al por mayor</p>
                <p class="text-gray-700 text-base ">
                    {{ product.formatted_wholesale_price }}
                </p>
            </div>
            <div class=" p-2 border-b-2 border-teal-400">
                <p class="text-gray-800 font-bold ">Precio al por menor</p>
                <p class="text-gray-700 text-base ">
                    {{ product.formatted_retail_price }}
                </p>
            </div>

            <div class=" p-2 ">
                <p class="text-gray-800 font-bold ">Precio distribuidor</p>
                <p class="text-gray-700 text-base ">
                    {{ product.formatted_distributor_price }}
                </p>
            </div>
        </div>
    </div>
</template>
<script>
import RemoveProductComponent from "./RemoveProductComponent.vue";
import AddToSale from "../sales/AddToSale.vue";
import AddToPurchase from "../purchases/AddToPurchase.vue";
export default {
    data() {
        return {
            products: []
        };
    },
    props: {
        product: {
            type: Object,
            required: true
        },
        index: {
            type: Number
        },
        searchInSales: {
            type: Boolean
        },
        transactionType: {
            type: String
        }
    },
    components: {
        "remove-product": RemoveProductComponent,
        "add-to-purchase": AddToPurchase,
        "add-to-sale": AddToSale
    },
    computed: {
        darkMode() {
            return this.searchInSales
                ? "bg-gray-100 text-white"
                : "shadow-lg bg-white";
        }
    }
};
</script>
