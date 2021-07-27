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
            params:{page:1},
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
                this.search(this.params)
                    .then(res => {
                        if (res.data.data.length) {
                            this.params.page += 1;
                            this.products.push(...res.data.data);
                            $state.loaded();
                        } else {
                            $state.complete();
                        }
                    })
                    .catch(err => {});
        },
        matchingProducts(data) {
            this.products = data.products;
            this.params = data.params;
            this.infiniteId++;
        },
        reloadIndex() {
            console.log('entro')
            this.infiniteId++;
            this.params={ page : 1}
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
