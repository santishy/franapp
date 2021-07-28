<template>
    <li class="px-4 py-1 text-center flex flex-wrap justify-between">
        <p class="text-center">{{ category.name }}</p>
        <div>
            <a
                :href="`/categories/${category.id}/edit`"
                class="transition-all rounded border-2 border-blue-800 px-2 text-blue-700 hover:bg-blue-800 hover:text-white inline-block"
                ><i class="far fa-edit"></i
            ></a>
            <delete-category
                :category="category"
                class="inline-block"
            ></delete-category>
        </div>
    </li>
</template>
<script>
import DeleteCategory from "./DeleteCategory.vue";
export default {
    props: {
        category: {
            type: Object,
            required: true
        }
    },
    components: {
        DeleteCategory
    },
    created() {},
    data() {
        return {
            fill: false
        };
    },
    methods: {}
};
</script>
