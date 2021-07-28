<template>
    <nav-component>
        <div>
            <category-form :uri="`/categories/${category.id}`"> </category-form>
        </div>
    </nav-component>
</template>
<script>
import NavComponent from "../NavComponent.vue";
import CategoryForm from "./CategoryForm.vue";

export default {
    components: {
        NavComponent,
        CategoryForm
    },
    props: {
        method: {
            type: String
        },
        category: {
            type: Object
        }
    }
};
</script>
