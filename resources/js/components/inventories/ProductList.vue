<template>
    <div v-if="inventory" class="justify-center">
        <div class="p-2 rounded-sm shadow-sm mb-4 bg-primary font-mono  text-white">
            {{ inventory && inventory.name ? inventory.name : '' }} | Existencias totales: <span class="font-bold text-slate-800">{{
    totalStocks
}}</span></div>
        <div class="
                flex flex-wrap
                justify-center
                items-center
                border-gray-300
                relative
            ">
            <h3 class="
                    w-64
                    text-gray-800
                    font-mono font-semibold
                    text-center
                    bg-purple-200
                    absolute
                    left-0
                    py-5
                    invisible
                    m:visible
                    px-4
                    leading-tight
                ">
                <warehouse-icon></warehouse-icon> {{ inventory.name }}
            </h3>
            <inventory-search-filter class="w-full"></inventory-search-filter>
        </div>

        <table v-if="inventory" class="min-w-full border-collapse block md:table shadow-sm text-center rounded-sm">
            <thead class="block md:table-header-group">
                <tr class="
                        border-b border-gray-500
                        md:border-none
                        block
                        md:table-row
                        absolute
                        -top-full
                        md:top-auto
                        -left-full
                        md:left-auto md:relative
                    ">
                    <th class="
                            bg-blue-700
                            p-2
                            text-white
                            font-semibold
                            md:border md:border-grey-500
                            text-left
                            block
                            md:table-cell
                        ">
                        Categoría
                    </th>
                    <th class="
                            bg-blue-700
                            p-2
                            text-white
                            font-semibold
                            md:border md:border-grey-500
                            text-left
                            block
                            md:table-cell
                        ">
                        SKU
                    </th>
                    <th class="
                            bg-blue-700
                            p-2
                            text-white
                            font-semibold
                            md:border md:border-grey-500
                            text-left
                            block
                            md:table-cell
                        ">
                        Descripción
                    </th>
                    <th class="
                            bg-blue-700
                            p-2
                            text-white
                            font-semibold
                            md:border md:border-grey-500
                            text-left
                            block
                            md:table-cell
                        ">
                        Existencias
                    </th>
                </tr>
            </thead>
            <transition-group tag="tbody" class="block md:table-row-group alternate-table-row " name="bounce"
                @after-leave="afterLeave">
                <produc-list-item v-for="(product, index) in products" :key="product.id" :index="index" :product="product"
                    :inventory="inventory">
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
import WarehouseIcon from "../icons/WarehouseIcon.vue";
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
    },
    data() {
        return {
            products: [],
            inventory: null,
            page: 1,
            infiniteId: +new Date(),
            filters: {},
            totalStocks: 0 //cuando exista mas d un inventario habria que resetar este valor o setear mejor dicho para una nueva busqueda d existencias
        };
    },
    created() {
        EventBus.$on("selected-inventory", (inventory) => {
            this.totalStocks = "..."
            this.filters = {};
            this.inventory = inventory;
            this.reloadIndex();
        });
        EventBus.$on("updated-stock", (data) => {
            this.products[data.index].stock = data.newStock;
        });
        EventBus.$on("search-value-added", this.addFilterSearch);
    },
    methods: {
        getProducts($state) {
            axios
                .get(`/inventories/${this.inventory.id}`, {
                    params: {
                        page: this.page,
                        inventory_id: this.inventory.id,
                        ...this.filters,
                    },
                })
                .then((res) => {
                    console.log(res.data?.total_stocks)
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
            /*setTimeout(()=>{
                this.$refs.infiniteLoading.stateChanger.reset();
            },1000)*/
        },
        afterLeave() {
            this.$nextTick(() => {
                if (!this.$refs.infiniteLoading.status) {
                    this.$refs.infiniteLoading.stateChanger.reset();
                }
            });
        },
        addFilterSearch(value) {
            this.filters["filter[search]"] = value;
            this.reloadIndex();
        },
    },
};
</script>
