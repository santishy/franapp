<template>
    <nav-component>
        <div class="grid grid-cols-1 gap-4 px-4 md:grid-cols-4 2xl:grid-cols-4">
            <div
                class="
                    flex flex-col
                    items-baseline
                    justify-center
                    col-span-5
                    md:col-span-4
                    2xl:col-span-5
                    sm:flex-row
                "
            >
                <search-by-category
                    class="w-full mb-4 mr-2 md:w-2/4 sm:mb-0"
                    :categories="categories"
                ></search-by-category>
                <search-component ref="search" class="w-full md:w-2/4" />
            </div>
            <div class="text-xl font-extralight">{{windowResizing}}</div>
            <product-list v-if="!isMobile" class="col-span-5">
                <product-list-item
                    v-for="(product, index) in products"
                    :key="product.id"
                    :product="product"
                    :index="index"
                >
                </product-list-item>
            </product-list>
            <product-card 
                v-else
                v-for="(product, index) in products"
                :key="product.id"
                :product="product"
                :index="index"
                transaction-type="purchase"
                class="col-span-5 md:col-span-1"
            >
                <template slot="options">
                    <add-to-purchase
                        :product_id="product.id"
                        :purchase_price="product.distributor_price"
                        :index="index"
                    ></add-to-purchase>
                    <a
                        :href="`/products/${product.id}/edit`"
                        class="
                            px-2
                            py-2
                            text-2xl
                            font-bold
                            text-gray-600
                            bg-white
                            rounded-full
                            shadow-xs
                            hover:text-gray-800
                        "
                        v-can="'edit product'"
                    >
                        <edit-icon></edit-icon>
                    </a>
                    <remove-product-component
                        :product="product"
                        :index="index"
                    />
                </template>
            </product-card>
            <infinite-loading
                :identifier="infiniteId"
                @infinite="infiniteHandler"
            ></infinite-loading>
        </div>
        <information-component>
            <template slot="title"> Productos </template>
            <message
                :title="modalDataConfirm.title"
                :message="modalDataConfirm.message"
            ></message>
            <template slot="button">
                <agree
                    :method="modalDataConfirm.action"
                    @deleteProduct="deleteProduct"
                ></agree>
            </template>
        </information-component>
    </nav-component>
</template>
<script>
import Agree from "../alerts/Agree.vue";
import Message from "../alerts/Message.vue";
import NavComponent from "../NavComponent.vue";
import InfiniteLoading from "vue-infinite-loading";
import SearchComponent from "./SearchComponent.vue";
import SearchByCategory from "./SearchByCategory.vue";
import { mapActions, mapState, mapMutations } from "vuex";
import ProductCardComponent from "./ProductCardComponent.vue";
import InformationComponent from "../modals/InformationComponent.vue";
import AddToPurchase from "../purchases/AddToPurchase.vue";
import EditIcon from "../icons/EditIcon.vue";
import RemoveProductComponent from "./RemoveProductComponent.vue";
import checkMobile from "../../helpers/CheckMobile.js";
import ProductList from "./ProductList.vue";
import ProductListItem from "./ProductListItem.vue";
import ResizeObs from "../../helpers/ResizeObs.js"
export default {
    components: {
        "product-card": ProductCardComponent,
        ProductList,
        ProductListItem,
        InfiniteLoading,
        SearchComponent,
        NavComponent,
        InformationComponent,
        Agree,
        Message,
        SearchByCategory,
        AddToPurchase,
        RemoveProductComponent,
        EditIcon,
    },
    props: {
        categories: {
            type: Array,
        },
    },
    data() {
        return {
            products: [],
            page: 1,
            wantedProduct: null,
            params: { page: 1 },
            infiniteId: 1,
            obj: new Object(),
            arr: new Array(),
            message: null,
        };
    },
    created() {
        this.cleanLocalStorage();

        this.getQueryType();
        
    },
    mounted() {
        
        this.cleanLocalStorage();
        EventBus.$on("matching-products", this.matchingProducts);
        EventBus.$on("empty-search", this.reloadIndex);
        EventBus.$on("failed-deletion", (message) => {
            this.message = message;
        });
    },
    methods: {
        ...mapActions(["getProducts", "search"]),
        ...mapMutations(["setModalDataConfirm","SET_QUERY_TYPE"]),
        getQueryType(){
            let url = new URL(window.location.href);
            this.SET_QUERY_TYPE(url.searchParams.get('queryType'));
        },
        removeFromArray(index) {
            this.products.splice(index, 1);
        },
        infiniteHandler($state) {
            this.search(this.params)
                .then((res) => {
                    if (res.data.data.length) {
                        this.params.page += 1;
                        this.products.push(...res.data.data);
                        $state.loaded();
                    } else {
                        $state.complete();
                    }
                })
                .catch((err) => {});
        },
        matchingProducts(data) {
            this.products = data.products;
            this.params = data.params;
            this.infiniteId++;
        },
        reloadIndex() {
            console.log("entro");
            this.infiniteId++;
            this.params = { page: 1 };
            this.products = [];
        },
        cleanLocalStorage() {
            if (
                document.head.querySelector('meta[name="purchase_id"]')
                    .content == "" ||
                document.head.querySelector('meta[name="purchase_id"]')
                    .content == null
            )
                localStorage.removeItem("productsInPurchase");
        },
        deleteProduct() {
            EventBus.$emit("open-modal", false);
            axios
                .delete(`/products/${this.modalDataConfirm.product.id}`)
                .then((res) => {
                    if (res.data) {
                        if (res.data.deleted) {
                            this.removeFromArray(this.modalDataConfirm.index);
                            this.setModalDataConfirm({});
                            return;
                        }
                        this.setModalDataConfirm({
                            message: res.data.message,
                            title: "No se pudo eliminar",
                        });
                        EventBus.$emit("open-modal", true);
                    }
                })
                .catch((err) => {
                    console.log(err);
                });
        },
    },
    computed: {
        ...mapState(["modalDataConfirm"]),
        isMobile(){
            return checkMobile();
        },
        windowResizing(){
            let resizeObserver = new ResizeObs();
            console.log("getter: ",resizeObserver.windowWidth)
            return resizeObserver.windowWidth;
        }
    },
};
</script>
