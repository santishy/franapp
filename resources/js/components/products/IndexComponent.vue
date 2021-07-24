<template>
    <nav-component>
        <div class="grid  grid-cols-1 md:grid-cols-3 gap-4 ">
            <div class="col-span-3 flex justify-center">
                <search-component ref="search" class="md:w-1/4 w-3/4" />
            </div>
            <product-card
                v-for="(product, index) in products"
                :key="product.id"
                :product="product"
                :index="index"
                transaction-type="purchase"
                class="col-span-3 md:col-span-1"
            />

            <infinite-loading
                :identifier="infiniteId"
                @infinite="infiniteHandler"
            ></infinite-loading>
        </div>
    </nav-component>
</template>
<script>
import ProductCardComponent from "./ProductCardComponent.vue";
import InfiniteLoading from "vue-infinite-loading";
import SearchComponent from "./SearchComponent.vue";
import { mapActions } from "vuex";
import NavComponent from "../NavComponent.vue";
export default {
    data() {
        return {
            products: [],
            page: 1,
            wantedProduct: null,
            infiniteId: 1,
            obj: new Object(),
            arr: new Array()
        };
    },
    created() {
        this.cleanLocalStorage();
    },
    mounted() {
        this.cleanLocalStorage();
        EventBus.$on("product-removed", this.removeFromArray);
        EventBus.$on("matching-products", this.matchingProducts);
        EventBus.$on("empty-search", this.reloadIndex);
    },
    components: {
        "product-card": ProductCardComponent,
        InfiniteLoading,
        "search-component": SearchComponent,
        NavComponent
    },
    methods: {
        ...mapActions(["getProducts", "search"]),
        removeFromArray(index) {
            this.products.splice(index, 1);
        },
        infiniteHandler($state) {
            if (this.wantedProduct) {
                const params = {
                    'filter[search]': this.wantedProduct,
                    page: this.page
                }
                this.search(params)
                    .then(res => {
                        if (res.data.data.length) {
                            this.page += 1;
                            this.products.push(...res.data.data);
                            $state.loaded();
                        } else {
                            $state.complete();
                        }
                    })
                    .catch(err => {});
            } else {
                this.getProducts(this.page)
                    .then(res => {
                        if (res.data.data.length) {
                            this.page += 1;
                            this.products = this.products.concat(res.data.data);
                            $state.loaded();
                        } else {
                            $state.complete();
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    });
            }

            /*  infiniteHandler($state) {
            if (this.wantedProduct) {
                this.obj.sku = this.wantedProduct;
                this.obj.page = this.page;
                this.search(this.obj)
                    .then(res => {
                        if (res.data.data.length) {
                            this.page += 1;
                            this.products.push(...res.data.data);
                            $state.loaded();
                        } else {
                            $state.complete();
                        }
                    })
                    .catch(err => {});
            } else {
                this.getProducts(this.page)
                    .then(res => {
                        if (res.data.data.length) {
                            this.page += 1;
                            this.products = this.products.concat(res.data.data);
                            $state.loaded();
                        } else {
                            $state.complete();
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    });
            } */
        },
        matchingProducts(data) {
            this.products = data.products;
            this.wantedProduct = data.sku;
            this.page = data.page + 1;
            this.infiniteId++;
        },
        reloadIndex() {
            this.infiniteId++;
            this.wantedProduct = null;
            this.page = 1;
            this.products = []
        },
        cleanLocalStorage() {
            if (
                document.head.querySelector('meta[name="purchase_id"]')
                    .content == "" ||
                document.head.querySelector('meta[name="purchase_id"]')
                    .content == null
            )
                localStorage.removeItem("productsInPurchase");
        }
    }
};
</script>
