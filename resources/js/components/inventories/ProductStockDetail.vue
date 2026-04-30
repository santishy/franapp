<template>
    <div class="space-y-5 ">
        <div class="border-b border-gray-200 p-2 flex flex-col  justify-center ">
            <p class="text-sm font-semibold text-blue-700 ">{{ product.sku }}</p>
            <h4 class="font-semibold text-base mt-1 text-gray-900">{{ product.description }}</h4>
        </div>
        <div class="grid sm:grid-cols-3 grid-cols-1 rounded-sm border border-gray-200 overflow-hidden">
            <div class="p-2 border-t sm:border-t-0  bg-gray-50 grid-cols-1">
                <p class="text-gray-600 text-xs font-semibold">Costo</p>
                <p class="text-gray-900 mt-1 text-sm font-bold">{{ product.formatted_distributor_price }}</p>
            </div>
            <div class="p-2 border-t sm:border-t-0 sm:border-l border-gray-200   bg-gray-50 grid-cols-1">
                <p class="text-gray-600 text-xs font-semibold">Precio Menudeo</p>
                <p class="text-gray-900 mt-1 text-sm font-bold">{{ product.formatted_retail_price }}</p>
            </div>
            <div class="p-2 border-t sm:border-t-0 sm:border-l border-gray-200 bg-gray-50 grid-cols-1">
                <p class="text-gray-600 text-xs font-semibold">Precio Mayoreo</p>
                <p class="text-gray-900 mt-1 text-sm font-bold">{{ product.formatted_wholesale_price }}</p>
            </div>
        </div>
        <div class="border border-gray-200 rounded-md overflow-hidden">
            <div class="grid grid-cols-2 text-gray-600 uppercase bg-gray-100">
                <div class=" px-3 py-2">
                    Inventario
                </div>
                <div class="px-3 py-2 text-right">
                    Existencias
                </div>
            </div>
            <div v-if="!InventoryWithProductStock" class="w-full p-3 text-center">
                Cargando existencias...
            </div>
            <template v-else>
                <div :class="!(index % 2) ? 'bg-gray-50' : 'bg-white'" class="grid grid-cols-2 "
                    v-for="(inventory, index) in InventoryWithProductStock" :key="inventory.id">
                    <div class="px-3 py-2 text-gray-800">
                        {{ inventory.name }}
                    </div>
                    <div :class="[inventory.stock ? 'text-gray-900' : 'text-gray-400']"
                        class="px-3 py-2 font-semibold text-right ">
                        {{ inventory.stock }}
                    </div>
                </div>
            </template>
        </div>
    </div>
</template>
<script>


export default {
    props: {
        product: {
            type: Object,
        },
    },
    data() {
        return {
            InventoryWithProductStock: null,
        }
    },
    methods: {
        getProductStock() {
            axios.get(`/products/${this.product.id}/stock`).then(response => {
                this.InventoryWithProductStock = response.data.data;
            }).catch(error => {
                console.error('Error fetching product stock:', error);
            });
        },
    },
    watch: {
        product: {
            immediate: true,
            handler(newValue) {
                this.InventoryWithProductStock = null; // Limpia los datos si no hay producto
                if (newValue && newValue.id) {
                    this.getProductStock();
                    return;
                }

            },
            deep: true,
        },

    },
};
</script>