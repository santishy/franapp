<template>
    <div class="justify-center">
        <teleport to="#modals">
            <information-component id="product-stock" size="xl">
                <template #title>
                    Existencias por inventario
                </template>
                <product-stock-detail v-if="productSelected" :product="productSelected" />
            </information-component>
        </teleport>

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">

            <p
                class="text-lg px-3 py-1 sm:w-2/5 text-center font-semibold uppercase text-gray-500 bg-white border border-sky-700 rounded">
                Existencias totales: <span class="font-bold text-gray-900">{{ totalStocks }}</span>
            </p>

            <inventory-search-filter class="w-full sm:w-3/5" />
        </div>

        <table class="min-w-full border-collapse block md:table shadow-sm text-center rounded-sm">
            <thead class="block md:table-header-group">
                <tr class="

                        md:border-none
                        block
                        md:table-row
                        absolute
                        -top-full
                        md:top-auto
                        -left-full
                        md:left-auto md:relative
                        bg-sky-600
                    ">
                    <th class="

                            p-2
                            text-white
                            font-semibold

                            text-left
                            block
                            md:table-cell
                        ">
                        Categoría
                    </th>
                    <th class="

                            p-2
                            text-white
                            font-semibold

                            text-left
                            block
                            md:table-cell
                        ">
                        SKU
                    </th>
                    <th class="

                            p-2
                            text-white
                            font-semibold

                            text-left
                            block
                            md:table-cell
                        ">
                        Descripción
                    </th>
                    <th class="
                            p-2
                            text-white
                            font-semibold

                            text-left
                            block
                            md:table-cell
                        ">
                        Existencias
                    </th>
                </tr>
            </thead>
            <transition-group tag="tbody" class="block md:table-row-group alternate-table-row " name="bounce">
                <produc-list-item v-for="(product, index) in products" @product-selected="onProductSelected"
                    :key="product.id" :index="index" :product="product" :inventory="inventory">
                </produc-list-item>
            </transition-group>
        </table>
        <infinite-loading :identifier="infiniteId" @infinite="getProducts" ref="infiniteLoading"></infinite-loading>
    </div>
</template>
<script>
import SearchComponent from "../products/SearchComponent.vue";
import InventorySearchFilter from "./InventorySearchFilter.vue";
import ProducListItem from "./ProducListItem.vue";
import InformationComponent from "../modals/InformationComponent.vue";
import WarehouseIcon from "../icons/WarehouseIcon.vue";
import ProductStockDetail from "./ProductStockDetail.vue";
export default {
    props: {
        index: {
            type: Number,
        },
    },
    components: {
        ProducListItem,
        SearchComponent,
        InventorySearchFilter,
        WarehouseIcon,
        ProductStockDetail,
        InformationComponent,

    },
    data() {
        return {
            products: [],
            inventory: null,
            page: 1,
            infiniteId: +new Date(),
            filters: {},
            productSelected: null,
            totalStocks: 0 //cuando exista mas d un inventario habria que resetar este valor o setear mejor dicho para una nueva busqueda d existencias
        };
    },
    created() {
        EventBus.$on("selected-inventory", this.setSelectedInventory);
        EventBus.$on("updated-stock", this.updateStock);
        EventBus.$on("search-value-added", this.addFilterSearch);
    },
    beforeUnmount() {
        EventBus.$off("selected-inventory", this.setSelectedInventory);
        EventBus.$off("updated-stock", this.updateStock);
        EventBus.$off("search-value-added", this.addFilterSearch);
    },
    methods: {
        setSelectedInventory(inventory) {
            this.totalStocks = "..."
            this.filters = {};
            this.inventory = inventory;
            this.reloadIndex();
        },
        updateStock(data) {
            this.products[data.index].stock = data.newStock;
        },
        getProducts($state) {
            axios
                .get(`/products-stock`, {
                    params: {
                        page: this.page,
                        ...this.filters,
                    },
                })
                .then((res) => {
                    if (res.data?.total_stocks) {
                        this.totalStocks = res.data.total_stocks;
                    }
                    if (res.data.products.length) {
                        this.page += 1;
                        this.products.push(...res.data.products);
                        $state.loaded();
                    } else {
                        $state.complete();
                    }
                })
                .catch((err) => {
                    $state.complete();
                    this.getErrors(err);
                });
        },
        reloadIndex() {
            /**
             * New learning, uso $nexTick(), por que no me actualizaba el infinite
             * loading, ya que al parecer no detectava que se borraban los elementos
             * del DOM y no ejecutaba la llamada asincrona para llenar el siguiente
             * inventario, aun cuando cambiaba el inifiniteID, asi que nexTick
             * devuelve la version mas actual del DOM donde ya no hay elementos y
             * dispara la llamada asincrona
             */
            this.page = 1;
            this.products = [];
            this.infiniteId++;

        },

        addFilterSearch(value) {
            this.filters["filter[search]"] = value;
            this.reloadIndex();
        },
        onProductSelected(product) {
            this.productSelected = product;
            EventBus.$emit("open-modal-product-stock", true);
        },
    },
};
</script>
