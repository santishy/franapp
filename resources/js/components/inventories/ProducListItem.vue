<template>
    <tr>
        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{product.category_name}}</td>
        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ product.sku }}</td>
        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ product.description }}</td>
        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
            <input-stock
                v-if="show"
                :product="product"
                :inventory="inventory"
                :index="index"
            ></input-stock>
            <div
                class="text-lg text-blue-700 hover:text-indigo-500 transition-all cursor-pointer"
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
            type: Object
        },
        inventory:{
            type:Object
        },
        index:{
            type:Number
        }
    },
    components: {
        InputStock
    },
    created() {
        EventBus.$on("updated-stock",data => {
            this.show = false;
        })
    },
    data() {
        return {
            show: false
        };
    }
};
</script>
