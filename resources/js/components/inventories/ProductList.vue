<template>
    <div class="justify-center">
        <table v-if="inventory" class="table-auto text-center bg-white">
            <thead class="bg-purple-200">
                <th class="p-3">Categoría</th>
                <th class="p-3">SKU</th>
                <th class="p-3">Descripción</th>
                <th class="p-3">Existencias</th>
            </thead>
            <transition-group name="bounce" tag="tbody">
                <produc-list-item
                    v-for="(product, index) in products"
                    :key="product.id"
                    :index="index"
                    :product="product"
                    :inventory="inventory"
                >
                </produc-list-item>
            </transition-group>
            <infinite-loading
                :identifier="infiniteId"
                @infinite="getProducts"
            ></infinite-loading>
        </table>
    </div>
</template>
<script>
import SearchComponent from "../products/SearchComponent.vue";
import ProducListItem from "./ProducListItem.vue";
export default {
    props: {
        index: {
            type: Number
        }
    },
    components: { ProducListItem, SearchComponent },
    data() {
        return {
            products: [],
            inventory: null,
            page: 1,
            infiniteId: +new Date()
        };
    },
    created() {
        EventBus.$on("selected-inventory", inventory => {
            this.inventory = inventory;
            this.reloadIndex();
        });
        EventBus.$on("updated-stock", data => {
            this.products[data.index].stock = data.newStock;
        });
    },
    methods: {
        getProducts($state) {
            axios
                .get(`/inventories/${this.inventory.id}`, {
                    params: {
                        include: "products",
                        page: this.page,
                        inventory_id: this.inventory.id
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
                    console.log(err);
                });
        },
        reloadIndex() {
            this.page = 1;
            this.infiniteId++;
            //this.inventory = null;
            this.products = [];
        }
    }
};
</script>
