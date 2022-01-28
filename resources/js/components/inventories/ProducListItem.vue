<template>
    <tr
        class="
            bg-white
            border-b border-gray-400
            md:border-none
            block
            md:table-row
        "
    >
        <td
            class="
                p-2
                md:border md:border-grey-500
                text-left
                block
                md:table-cell
            "
        >
            <span class="inline-block w-1/3 md:hidden font-bold">Categoría</span
            >{{ product.category_name }}
        </td>
        <td
            class="
                p-2
                md:border md:border-grey-500
                text-left
                block
                md:table-cell
            "
        >
            <span class="inline-block w-1/3 md:hidden font-bold">SKU</span
            >{{ product.sku }}
        </td>
        <td
            class="
                p-2
                md:border md:border-grey-500
                text-left
                block
                md:table-cell
            "
        >
            <span class="inline-block w-1/3 md:hidden font-bold">Descripción</span
            >{{ product.description }}
        </td>
        <td
            class="
                p-2
                md:border md:border-grey-500
                text-left
                block
                md:table-cell
            "
        >
            <span class="inline-block w-1/3 md:hidden font-bold">Existencias</span>
            <input-stock
                v-if="show"
                :product="product"
                :inventory="inventory"
                :index="index"
            ></input-stock>
            <div
                class="
                    text-lg text-blue-700
                    hover:text-indigo-500
                    transition-all
                    cursor-pointer
                    inline-block
                "
                v-else
                @dblclick="show = true"
            >
                {{ product.stock }}
            </div>
        </td>
    </tr>
</template>
<script>
import InputStock from "./InputStock.vue";

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
    components: {
        InputStock,
    },
    created() {
        EventBus.$on("updated-stock", (data) => {
            this.show = false;
        });
    },
    data() {
        return {
            show: false,
        };
    },
};
</script>
