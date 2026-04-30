<template>
    <tr class="
            bg-white
            border-b border-gray-400
            md:border-none
            block
            md:table-row
        ">
        <td class="
                p-2
                md:border md:border-grey-500
                text-left
                block
                md:table-cell
            ">
            <span class="inline-block w-1/3 md:hidden font-bold">Categoría</span>{{ product.category_name }}
        </td>
        <td class="
                p-2
                md:border md:border-grey-500
                text-left
                block
                md:table-cell
            ">
            <span class="inline-block w-1/3 md:hidden font-bold">SKU</span>{{ product.sku }}
        </td>
        <td class="
                p-2
                md:border md:border-grey-500
                text-left
                block
                md:table-cell
            ">
            <span class="inline-block w-1/3 md:hidden font-bold">Descripción</span>{{ product.description }}
        </td>
        <td class="
                p-2
                md:border md:border-grey-500
                text-left
                block
                md:table-cell
            ">
            <span class="inline-block w-1/3 md:hidden font-bold">Existencias</span>
            <div class="
                    text-lg 
                    transition-all
                    inline-block
                    text-gray-700

                ">
                <div class="flex items-center justify-center">

                    <span>

                        {{ product.stock }}
                    </span>

                    <button @click="productSelect"
                        class="ml-2 inline-flex items-center justify-center rounded bg-gray-200 p-1 text-gray-600 hover:bg-blue-50 hover:text-blue-700">
                        <table-cells class="h-4 w-4" />
                    </button>
                </div>
            </div>
        </td>
    </tr>
</template>
<script>
import TableCells from '../icons/TableCells.vue';
export default {
    components: {
        TableCells,
    },
    props: {
        product: {
            type: Object,
        },
        inventory: {
            type: Object,
        },
        index: {
            type: Number,
        },
    },
    methods: {
        productSelect() {
            this.$emit("product-selected", this.product);
        },
    },
    created() {
        EventBus.$on("updated-stock", (data) => {
            this.show = false;
        });
    },

};
</script>
