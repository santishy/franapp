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
                {{ product.stock }}
            </div>
        </td>
    </tr>
</template>
<script>

export default {
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
    created() {
        EventBus.$on("updated-stock", (data) => {
            this.show = false;
        });
    },

};
</script>
