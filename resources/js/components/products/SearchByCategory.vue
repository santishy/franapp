<template>
    <form @submit.prevent="submit">
        <select
            name="category_id"
            v-model="category_id"
            @change="handleSearh"
            class="block appearance-none w-full border-l-4 border-orange-400 bg-white hover:border-gray-500 py-5 px-4 pr-8 rounded leading-tight focus:outline-none focus:shadow-outline"
        >
            <option disabled value="" selected class="text-gray-600"
                >Categorías</option
            >
            <option
                v-for="category in categories"
                :key="category.id"
                :value="category.id"
                >{{ category.name }}</option
            >
        </select>
    </form>
</template>
<script>
import { mapActions } from "vuex";
export default {
    props: {
        categories: {
            type: Array
        }
    },
    data() {
        return {
            category_id: ""
        };
    },
    methods: {
        async handleSearh() {
            if (this.sku == "" || this.sku == "") {
                return EventBus.$emit("empty-search");
            }
            try {
                const { data } = await this.search(this.category_id);
                
            } catch (error) {
                console.log(error);
            }
        },
        ...mapActions(["search"])
    }
};
</script>
