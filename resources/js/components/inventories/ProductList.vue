<template>
    <div v-if="inventory">
        <table class="table-auto text-center bg-white">
            <thead class="bg-purple-200">
                <th class="p-3">SKU</th>
                <th class="p-3">Descripción</th>
                <th class="p-3">Existencias</th>
                <th class="p-3">Acciones</th>
            </thead>
            <transition-group name="bounce" tag="tbody">
                <tr v-for="product in products" :key="product.id">
                    <td class="border px-4 py-2">{{ product.sku }}</td>
                    <td class="border px-4 py-2">{{ product.description }}</td>
                    <td class="border px-4 py-2">{{ product.stock }}</td>
                    <td class="border px-4 py-2"></td>
                </tr>
            </transition-group>
        </table>
        <infinite-loading
            :identifier="infiniteId"
            @infinite="getProducts"
        ></infinite-loading>
    </div>
</template>
<script>
import InfiniteLoading from "vue-infinite-loading";
export default {
    data() {
        return {
            products: [],
            inventory: null,
            page:1,
            infiniteId: 1,
        };
    },
    mounted() {
        EventBus.$on("selected-inventory", inventory => {
            this.products = []
            this.reloadIndex()
            this.inventory = inventory;
            
        });
    },
    methods: {
        getProducts($state) {
            axios
                .get(`/inventories/${this.inventory.id}`, {
                    params: {
                        include: "products",
                        page:this.page
                    }
                })
                .then(res => {
                    if (res.data.data.products.length) {
                        this.page += 1;
                        this.products.push(...res.data.data.products);
                        $state.loaded();
                    }else{
                        $state.complete();
                    }
                })
                .catch(err => {
                    console.log(err);
                });
        },
        reloadIndex() {
            this.infiniteId++;
            this.inventory = null;
            this.page = 1;
        },
    }
};
</script>
