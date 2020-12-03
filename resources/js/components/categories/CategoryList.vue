<template>
    <ul>
        <li>{{categories}}</li>
        <category-list-item 
            v-for="category in categories"
            :key="category.id"
            :category="category"
        >
        </category-list-item>
    </ul>
</template>
<script>
import CategoryListItem from './CategoryListItem'
export default {
    components:{'category-list-item':CategoryListItem},
    props:{
        categories:{
            type:Array
        }
    }
}
</script>