<template>
    <div v-if="inventory" class="justify-center">
        <div
            class=" flex flex-wrap  justify-center items-center border-gray-300"
        >
            <h3
                class=" border-l-4 border-teal-500 bg-white py-5 px-4  leading-tight"
            >
                {{ inventory.name }}
            </h3>
            <inventory-search-filter></inventory-search-filter>
        </div>
        <table v-if="inventory" class="text-center bg-white">
            <thead class="bg-purple-200">
                <th class="p-3">Categoría</th>
                <th class="p-3">SKU</th>
                <th class="p-3">Descripción</th>
                <th class="p-3">Existencias</th>
            </thead>
            <transition-group
                tag="tbody"
                name="bounce"
               
            >
                <produc-list-item
                    v-for="(product, index) in products"
                    :key="product.id"
                    :index="index"
                    :product="product"
                    :inventory="inventory"
                >
                </produc-list-item>
            </transition-group>
        </table>
        <infinite-loading
            :identifier="infiniteId"
            @infinite="getProducts"
        ></infinite-loading>
    </div>
</template>
<script>
import SearchComponent from "../products/SearchComponent.vue";
import InventorySearchFilter from "./InventorySearchFilter.vue";
import ProducListItem from "./ProducListItem.vue";
export default {
    props: {
        index: {
            type: Number
        }
    },
    components: { ProducListItem, SearchComponent, InventorySearchFilter },
    data() {
        return {
            products: [],
            inventory: null,
            page: 1,
            infiniteId: +new Date(),
            filters: {}
        };
    },
    created() {
        EventBus.$on("selected-inventory", inventory => {
            this.filters = {};
            this.inventory = inventory;
            this.reloadIndex();
        });
        EventBus.$on("updated-stock", data => {
            this.products[data.index].stock = data.newStock;
        });
        EventBus.$on("search-value-added", this.addFilterSearch);
    },
    methods: {
        
        async getProducts($state) {
            await axios
                .get(`/inventories/${this.inventory.id}`, {
                    params: {
                        page: this.page,
                        inventory_id: this.inventory.id,
                        ...this.filters
                    }
                })
                .then(res => {
                    if (res.data.data.length) {
                        this.page += 1;
                        this.products.push(...res.data.data);
                        $state.loaded();
                    } else {
                        $state.complete();
                    }
                })
                .catch(err => {
                    $state.complete();
                    this.getErrors(err);
                });
        },
        reloadIndex() {
            this.page = 1;
            this.products = [];
            this.infiniteId++;
            //this.inventory = null;
            console.log(this.infiniteId);
        },
        addFilterSearch(value) {
            this.filters["filter[search]"] = value;
            this.reloadIndex();
        }
    }
};
</script>
