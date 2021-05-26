<template>
    <ul class="w-full rounded shadow bg-white">
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
        axios.get('/categories').then((res) => {
            this.categories=res.data.data
        })
    }
};
</script>
