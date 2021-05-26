<template>
    <ul class="w-full rounded shadow bg-white p-4">
        <category-list-item
            v-for="category in categories"
            :category="category"
            :key="category.id"
        ></category-list-item>
    </ul>
</template>
<script>
import CategoryListItem from "./CategoryListItem.vue";
export default {
    components: { "category-list-item": CategoryListItem },
    data(){
        return{
            categories:[]
        }
    },
    created(){
        console.clear();
        EventBus.$on('category-created',category => {
            this.categories.unshift(category);
        })
        axios.get('/categories').then((res) => {
            this.categories=res.data.data
        })
    }
};
</script>
