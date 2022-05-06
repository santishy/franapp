<template>
    <div
        class="overflow-hidden rounded"
        :class="[
            darkMode,
            selected ? 'border-2 border-red-400 bg-red-200' : '',
        ]"
    >
        <div class="text-justify" :class="['text-justify']">
            <div
                class="flex flex-wrap items-center justify-between p-2 bg-gray-600 "
            >
                <!-- <add-to-purchase
                    :product_id="product.id"
                    :purchase_price="product.distributor_price"
                    :index="index"
                />
                <a
                    :href="`/products/${product.id}/edit`"
                    class="px-2 py-2 text-2xl font-bold text-gray-600 bg-white rounded-full shadow-xs hover:text-gray-800"
                    v-can="'edit product'"
                >
                    <edit-icon></edit-icon>
                </a>
                <remove-product :product="product" :index="index" />
                <add-to-sale :product="product" :index="index"></add-to-sale> -->
                <slot name="options"></slot>
            </div>
            <div class="w-full">
                <img
                    :src="product.image_url"
                    alt="product.sku"
                    class="object-contain md:object-scale-down"
                />
            </div>

            <div class="px-4 py-2 border border-gray-300">
                <p
                    class="flex flex-wrap items-center justify-between font-semibold text-gray-700 "
                >
                    <span class="flex flex-wrap"> SKU </span>

                    <span
                        class="p-1 font-mono text-base font-light text-blue-800 uppercase bg-teal-300 rounded "
                    >
                        {{ product.sku }}
                    </span>
                </p>
            </div>
            <div class="px-4 py-2 border border-gray-300">
                <p
                    class="flex flex-wrap justify-between font-semibold text-gray-700 "
                >
                    <span class="flex flex-wrap"> Categoría </span>
                    <span class="font-mono text-base font-light uppercase">{{
                        product.category_name
                    }}</span>
                </p>
            </div>
            <div class="px-4 py-2 border border-gray-300">
                <p
                    class="flex flex-wrap justify-between font-bold text-gray-700 "
                >
                    <span class="flex flex-wrap"> Descripción </span>
                    <span class="font-mono text-base font-light uppercase">
                        {{ product.description }}
                    </span>
                </p>
            </div>
            <div class="px-4 py-2 border border-gray-300">
                <p
                    class="flex flex-wrap justify-between font-bold text-gray-700 "
                >
                    <span class="flex flex-wrap"> Precio al por mayor </span>
                    <span class="font-mono text-base font-light uppercase">
                        {{ product.formatted_wholesale_price }}
                    </span>
                </p>
            </div>
            <div class="px-4 py-2 border border-gray-300">
                <p
                    class="flex flex-wrap justify-between font-bold text-gray-700 "
                >
                    <span class="flex flex-wrap"> Precio al por menor </span>
                    <span class="font-mono text-base font-light uppercase">
                        {{ product.formatted_retail_price }}
                    </span>
                </p>
            </div>

            <div class="px-4 py-2 border border-gray-300">
                <p
                    class="flex flex-wrap justify-between font-bold text-gray-700 "
                >
                    <span class="flex flex-wrap">
                        Precio distribuidor

                    </span>
                    <span class="font-mono text-base font-light uppercase">
                        {{ product.formatted_distributor_price }}</span
                    >
                </p>
            </div>
        </div>
    </div>
</template>
<script>

import ArrowNarrowRightIcon from "../icons/ArrowNarrowRightIcon.vue";
import { mapState } from "vuex";
export default {
    components: {
        ArrowNarrowRightIcon,
    },
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
