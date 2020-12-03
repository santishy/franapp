<template>
    <ul>
        <category-list-item 
            v-for="category in categories"
            :category="category"
            :key="category.id"   
        ></category-list-item>
    </ul>
</template>
<script>
import CategoryListItem from './CategoryListItem.vue'
export default {
    components:{'category-list-item':CategoryListItem},
    props:{
        categories:{
            type:Array,
            required:true
        }
    }
}
</script>