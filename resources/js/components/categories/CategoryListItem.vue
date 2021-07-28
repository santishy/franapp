<template>
    <li class="px-4 py-1 text-center flex flex-wrap justify-between">
        <p class="text-center">{{ category.name }}</p>
        <a :href="`/categories/${category.id}/edit`" class="ml-4"><i class="far fa-edit"></i></a>
    </li>
</template>
<script>
export default {
    props: {
        category: {
            type: Object,
            required: true
        }
    },
    created() {
        
    },
    data() {
        return {
            fill: false
        };
    },
    methods: {
        
    },
};
</script>
