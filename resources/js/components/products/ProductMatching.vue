<template>
    <portal to="modals">
    <div v-if="isOpen" class="fixed inset-0 flex items-start mt-4 justify-center z-30">
        <div @click="isOpen = false" class="fixed inset-0 z-20 bg-black opacity-50"></div>
        <div class="
                w-full
                md:w-10/12
                h-5/6
                z-30
                rounded-lg
                shadow-lg
                overflow-y-scroll overflow-x-hidden
                bg-white
                py-6
                relative
                px-6
            ">
             <button @click="isOpen = false" class="
                        mb-2
                        text-2xl

                        p-0
                        absolute
                        m-0
                        top-2
                        right-2
                        rounded
                        bg-gray-50
                        shadow-lg
                    ">
                    <x-icon class="stroke-2 stroke-gray-500"></x-icon>
                </button>

            <div class="grid md:grid-cols-4 grid-cols-1 gap-4">
                <product-list :show-distributor-price="false" v-if="!isMobile && windowResizing > 960" class="col-span-5">
                    <product-list-item v-for="(product, index) in products" :key="product.id" :product="product"
                        :index="index">
                    </product-list-item>
                </product-list>
                <product-card v-else v-for="(product, index) in products" :key="product.id" :product="product"
                    :search-in-sales="true" :index="index">
                    <template slot="options">
                        <add-to-sale :product="product" :index="index"></add-to-sale>
                    </template>
                </product-card>
            </div>
            <infinite-loading @infinite="getProducts"></infinite-loading>
        </div>
    </div>
    </portal>
    </template>
<script>
import { mapActions } from "vuex";
import XIcon from "../icons/XIcon.vue";
import ProductCardComponent from "./ProductCardComponent";
import ProductListItem from "./ProductListItem.vue";
import ProductList from "./ProductList.vue"
import AddToSale from "../sales/AddToSale.vue";
import ResizeObs from "../../helpers/ResizeObs";
import checkMobile from "../../helpers/CheckMobile.js";

export default {
    components: {
        "product-card": ProductCardComponent,
        XIcon,
        ProductListItem,
        ProductList,
        AddToSale,
    },
    data() {
        return {
            products: [],
            isOpen: false,
            sku: "",
            params: {},
            resizeObserver: null
        };
    },
    created() {
        EventBus.$on("matching-products", (obj) => {
            this.products = obj.products;
            this.params = obj.params;
            this.isOpen = true;
        });
        EventBus.$on("toggle-product-list", () => {
            this.isOpen = !this.isOpen;
        })
        this.resizeObserver = new ResizeObs();
    },
    methods: {
        ...mapActions(["search"]),
        async getProducts($state) {
            try {
                const { data } = await this.search(this.params);
                if (data.data.length) {
                    this.params.page += 1;
                    this.products.push(...data.data);
                    $state.loaded();
                } else {
                    $state.complete();
                }
            } catch (error) { }
        },
    },
    computed: {
        isMobile() {
            return checkMobile();
        },
        windowResizing() {
            return this.resizeObserver.windowWidth;
        }
    }
};
</script>
