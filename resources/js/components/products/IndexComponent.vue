<template>
    <layout-component>
        <div class="grid grid-cols-1 gap-4 px-4 md:grid-cols-4 2xl:grid-cols-4">
            <div class="
                    flex flex-col
                    items-baseline
                    justify-center
                    col-span-5
                    md:col-span-4
                    2xl:col-span-5
                    sm:flex-row
                ">
                <search-by-category class="w-full mb-4 mr-2 md:w-2/4 sm:mb-0"
                    :categories="categories"></search-by-category>
                <search-component ref="search" class="w-full md:w-2/4" />
            </div>
            <product-list :showDistributorPrice="true" v-if="!isMobile && windowResizing > 960" class="col-span-5">
                <product-list-item v-for="(product, index) in products" :key="product.id" :product="product"
                    :index="index">
                </product-list-item>
            </product-list>

            <infinite-loading :identifier="infiniteId" @infinite="infiniteHandler"></infinite-loading>
        </div>
        <information-component>
            <template #title> Productos </template>
            <message :title="modalDataConfirm.title" :message="modalDataConfirm.message"></message>
            <template #button>
                <agree :method="modalDataConfirm.action" @deleteProduct="deleteProduct"></agree>
            </template>
        </information-component>
    </layout-component>
</template>
<script>
import Agree from "../alerts/Agree.vue";
import Message from "../alerts/Message.vue";
import InfiniteLoading from "v3-infinite-loading/lib/v3-infinite-loading.es.js";
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
            resizeObserver: null,
        };
    },
    created() {
        this.cleanLocalStorage();
        this.resizeObserver = new ResizeObs();
        this.getQueryType();

    },
    mounted() {

        this.cleanLocalStorage();
        EventBus.$on("matching-products", this.matchingProducts);
        EventBus.$on("empty-search", this.reloadIndex);
        EventBus.$on("failed-deletion", this.setFailedDeletionMessage);
    },
    beforeUnmount() {

        EventBus.$off("matching-products", this.matchingProducts);
        EventBus.$off("empty-search", this.reloadIndex);
        EventBus.$off("failed-deletion", this.setFailedDeletionMessage);
    },
    methods: {
        ...mapActions(["getProducts", "search"]),
        ...mapMutations(["setModalDataConfirm", "SET_QUERY_TYPE"]),
        setFailedDeletionMessage(message) {
            this.message = message;
        },
        getQueryType() {
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
                .catch((err) => { });
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
        isMobile() {
            return checkMobile();
        },
        windowResizing() {
            return this.resizeObserver.windowWidth;
        }

    },
};
</script>
