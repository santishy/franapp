<template>
    <div class="grid  grid-cols-1 sm:grid-cols-3 gap-4 mt-10">
        <div class="col-span-3 flex justify-center border py-8">
            <search-component ref="search" class="md:w-1/4 w-3/4" />
        </div>
        <product-card
            v-for="(product, index) in products"
            :key="product.id"
            :product="product"
            :index="index"
            class="col-span-3 md:col-span-1"
        />
        <infinite-loading @infinite="infiniteHandler"></infinite-loading>
    </div>
</template>
<script>
import ProductCardComponent from "./ProductCardComponent.vue";
import InfiniteLoading from "vue-infinite-loading";
import SearchComponent from "./SearchComponent.vue";
import { mapActions } from "vuex";
export default {
    data() {
        return {
            products: [],
            page: 1,
            wantedProduct:null,
        };
    },
    mounted() {
        EventBus.$on("product-removed", this.removeFromArray);
        EventBus.$on("matching-products", this.matchingProducts);
    },
    components: {
        "product-card": ProductCardComponent,
        InfiniteLoading,
        "search-component": SearchComponent
    },
    methods: {
        ...mapActions(["getProducts", "search"]),
        removeFromArray(index) {
            this.products.splice(index, 1);
        },
        infiniteHandler($state,promise=null) {
            if(this.wantedProduct || this.wantedProduct === ''){
                this.$refs.search.handleSearh(this.page)
                    .then((res) => {
                        if(res.products.length){
                            this.page += 1;
                            this.products = this.products.concat(res.products);
                            $state.loaded();
                        }
                        else{
                            $state.complete();
                        }
                    })
                    .catch((err) => {
                        console.log(err)
                    })
            }
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
        },
        matchingProducts(data){
            this.products = data.products;
            this.wantedProduct = data.sku;
            this.page = data.page + 1;
        }
       
    }
};
</script>
