<template>
    <div
        class="
            flex
            justify-center
            bg-white
            shadow-sm
            w-full
            rounded
            max-w-full
            sm:overflow-x-hidden
            overflow-x-auto
        "
    >
        <table
            class="
                min-w-full
                border-collapse
                block
                md:table
                shadow-sm
                text-center
                rounded-lg
            "
        >
            <thead class="block md:table-header-group">
                <tr
                    class="
                        border-b border-gray-500
                        rounded-t-sm
                        md:border-none
                        block
                        md:table-row
                        absolute
                        -top-full
                        md:top-auto
                        -left-full
                        md:left-auto md:relative
                    "
                >
                    <th class="bg-blue-700
                                    p-2
                                    text-white
                                    font-semibold
                                    md:border md:border-grey-500
                                    text-left
                                    block
                                    md:table-cell">SKU</th>
                    <th class="bg-blue-700
                                    p-2
                                    text-white
                                    font-semibold
                                    md:border md:border-grey-500
                                    text-left
                                    block
                                    md:table-cell">Categoría</th>
                    <th class="bg-blue-700
                                    p-2
                                    text-white
                                    font-semibold
                                    md:border md:border-grey-500
                                    text-left
                                    block
                                    md:table-cell">Descripción</th>
                    <th class="bg-blue-700
                                    p-2
                                    text-white
                                    font-semibold
                                    md:border md:border-grey-500
                                    text-left
                                    block
                                    md:table-cell">Precio</th>
                    <th class="bg-blue-700
                                    p-2
                                    text-white
                                    font-semibold
                                    md:border md:border-grey-500
                                    text-left
                                    block
                                    md:table-cell">Cantidad</th>
                    <th class="bg-blue-700
                                    p-2
                                    text-white
                                    font-semibold
                                    md:border md:border-grey-500
                                    text-left
                                    block
                                    md:table-cell">Total</th>
                    <th class="bg-blue-700
                                    p-2
                                    text-white
                                    font-semibold
                                    md:border md:border-grey-500
                                    text-left
                                    block
                                    md:table-cell">Acciones</th>
                </tr>
            </thead>
            <tbody class="block md:table-row-group alternate-table-row">
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
        ProductListItem,
    },
    props: {
        products: {
            type: Array,
        },
    },
};
</script>
