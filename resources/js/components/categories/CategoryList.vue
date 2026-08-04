<template>
    <ul class="w-full rounded shadow bg-white p-2 divide-y divide-gray-300 text-gray-700" v-can="'view categories'"
        v-cloak>
        <li class="px-4  form-header text-center  text-blue-800 text-xl font-semibold">
            Categorías
        </li>
        <category-list-item v-for="(category, index) in categories" :category="category" :index="index"
            :key="category.id"></category-list-item>
    </ul>
</template>
<script>
import { add } from "lodash";
import CategoryListItem from "./CategoryListItem.vue";
export default {
    components: { "category-list-item": CategoryListItem },
    data() {
        return {
            categories: []
        };
    },
    created() {
        EventBus.$on("category-created", this.addCategory);
        axios.get("/categories?ALL=TRUE").then(res => {
            this.categories = res.data.data;
        });
        EventBus.$on('deleted-category', this.removeCategory);
    },
    beforeUnmount() {
        EventBus.$off("category-created", this.addCategory);
        EventBus.$off("deleted-category", this.removeCategory)
    },
    methods: {
        addCategory(category) {
            this.categories.unshift(category);
        },
        removeCategory(index) {
            this.categories.splice(index, 1);
        }
    }
};
</script>
