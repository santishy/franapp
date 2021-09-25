<template>
    <div class="mx-auto">
        <table class="table-auto text-center">
            <thead>
                <tr class="bg-danger">
                    <th class="px-4 py-2 bg-gray-400">SKU</th>
                    <th class="px-4 py-2 bg-gray-400">Categoría</th>
                    <th class="px-4 py-2 bg-gray-400">Descripción</th>
                    <th class="px-4 py-2 bg-gray-400">Precio</th>
                    <th class="px-4 py-2 bg-gray-400">Cantidad</th>
                    <th class="px-4 py-2 bg-gray-400">Total</th>
                    <th  class="px-4 py-2 bg-gray-400">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <product-list-item
                    v-for="(product, index) in products"
                    :key="product.id"
                    :index="index"
                    :product="product"
                >
                </product-list-item>
            </tbody>
        </table>
    </div>
</template>

<script>
import ProductListItem from "./ProductListItem.vue";
export default {
    components: {
        ProductListItem
    },
    props: {
        products: {
            type: Array
        }
    }
};
</script>
