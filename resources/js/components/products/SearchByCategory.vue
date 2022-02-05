<template>
    <div class="w-full">
        <category-select
            class="
               
                relative
                block
                shadow-sm
                
                appearance-none
                border-l-4 border-orange-400
                bg-white
                hover:border-gray-500
                py-5
                pr-8
                rounded-sm
                leading-tight
                focus:outline-none focus:shadow-outline
            "
            :categories="categories"
        ></category-select>
    </div>
</template>
<script>
import { mapActions } from "vuex";
import CategorySelect from "./CategorySelect.vue";
export default {
    components: { CategorySelect },
    props: {
        categories: {
            type: Array,
        },
    },
    data() {
        return {
            category_id: "",
            params: {},
        };
    },
    mounted() {
        EventBus.$on("selected-category", (id) => {
            this.category_id = id;
            if (id) this.handleSearh();
        });
    },
    methods: {
        async handleSearh() {
            try {
                this.params["filter[byCategory]"] = this.category_id;
                this.params.page = 1;
                const { data } = await this.search(this.params);
                const products = data.data;
                this.params.page++;
                EventBus.$emit("matching-products", {
                    products,
                    params: this.params,
                });
            } catch (error) {
                console.log(error);
            }
        },
        ...mapActions(["search"]),
    },
};
</script>
