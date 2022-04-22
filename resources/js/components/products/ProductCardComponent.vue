<template>
    <div
        class="rounded overflow-hidden"
        :class="[
            darkMode,
            selected ? 'border-2 border-red-400 bg-red-200' : '',
        ]"
    >
        <div class="text-justify" :class="['text-justify']">
            <div class="w-full">
                <img
                    :src="product.image_url"
                    alt="product.sku"
                    class="object-contain md:object-scale-down"
                />
            </div>
            <div
                class="
                    flex flex-wrap
                    justify-between
                    bg-slate-50
                    [mask-image:linear-gradient(0deg,#fff,rgba(255,255,255,0.6))] dark:bg-grid-slate-700/25 dark:[mask-image:linear-gradient(0deg,rgba(255,255,255,0.1),rgba(255,255,255,0.5))]
                    items-center
                    p-2
                "
            >
                <add-to-purchase
                    :product_id="product.id"
                    :purchase_price="product.distributor_price"
                    :index="index"
                />
                <a
                    :href="`/products/${product.id}/edit`"
                    class="
                        rounded-full
                        hover:text-gray-800
                        shadow-xs
                        text-gray-600
                        font-bold
                        py-2
                        bg-white
                        px-2
                        text-2xl
                    "
                    v-can="'edit product'"
                >
                    <edit-icon></edit-icon>
                </a>
                <remove-product :product="product" :index="index" />
                <add-to-sale :product="product" :index="index"></add-to-sale>
            </div>
            <div class="py-1 pl-4 pr-2">
                <p class="text-gray-700 font-semibold mb-1">SKU</p>
                <p class="text-gray-600 text-base">
                    {{ product.sku }}
                </p>
            </div>
            <div class="py-1 pl-4 pr-2">
                <p class="text-gray-700 font-semibold mb-1">Categoría</p>
                <p class="text-gray-600 text-base">
                    {{ product.category_name }}
                </p>
            </div>
            <div class="py-1 pl-4 pr-2">
                <p class="text-gray-700 font-bold mb-1">Descripción</p>
                <p class="text-gray-600 text-base">
                    {{ product.description }}
                </p>
            </div>
            <div class="py-1 pl-4 pr-2">
                <p class="text-gray-700 font-bold mb-1">Precio al por mayor</p>
                <p class="text-gray-600 text-base">
                    {{ product.formatted_wholesale_price }}
                </p>
            </div>
            <div class="py-1 pl-4 pr-2">
                <p class="text-gray-700 font-bold mb-1">Precio al por menor</p>
                <p class="text-gray-600 text-base">
                    {{ product.formatted_retail_price }}
                </p>
            </div>

            <div class="py-1 pl-4 pr-2">
                <p class="text-gray-700 font-bold mb-1">Precio distribuidor</p>
                <p class="text-gray-600 text-base">
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
import EditIcon from "../icons/EditIcon.vue";
import { mapState } from "vuex";
export default {
    props: {
        product: {
            type: Object,
            required: true,
        },
        index: {
            type: Number,
        },
        searchInSales: {
            type: Boolean,
        },
        transactionType: {
            type: String,
        },
    },
    components: {
        "remove-product": RemoveProductComponent,
        "add-to-purchase": AddToPurchase,
        "add-to-sale": AddToSale,
        EditIcon,
    },
    mounted() {
        console.log(this.selected);
    },
    computed: {
        darkMode() {
            return this.searchInSales
                ? "bg-gray-100 text-white"
                : "shadow-lg bg-white";
        },
        selected() {
            var arr = this.productsInTransaction.filter((obj) => {
                return obj.id == this.product.id;
            });

            return this.searchInSales && Boolean(arr.length);
        },
        ...mapState(["productsInTransaction"]),
    },
};
</script>
