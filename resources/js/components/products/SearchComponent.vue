<template>
    <input type="text" v-model="sku" v-on:keyup.enter="handleSearch" placeholder="Busca por el SKU del producto"
        :class="styles" class="appearance-none py-3 px-2  leading-tight focus:outline-none" />
</template>
<script>
import { mapActions } from "vuex";
export default {
    props: ["styles"],
    data() {
        return {
            sku: "",
            page: 1
        };
    },
    created() {
        EventBus.$on("selected-inventory", this.addFilter);
    },
    methods: {
        ...mapActions(["search"]),
        handleSearch(e) {
            if (this.sku == "" || this.sku == "") {
                return EventBus.$emit("empty-search");
            }
            return new Promise((resolve, reject) => {
                const params = {
                    "filter[search]": this.sku,
                    page: this.page
                };
                this.search(params)
                    .then(res => {
                        if (this.page == 1) {
                            params.page++;
                            EventBus.$emit("matching-products", {
                                params,
                                products: res.data.data
                            });
                        }
                        resolve(res);
                    })
                    .catch(err => {
                        reject(err);
                    });
            });
        },
        setPage(page) {
            this.page = page;
        }
    }
};
</script>
