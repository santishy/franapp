<template>
    <form @submit.prevent="submit">
        <div class="flex flex-wrap">
            <input class="text-center" type="number" name="stock" v-model="form.stock" />
            <button type="submit">
                <i class="fas fa-edit"></i>
            </button>
        </div>
    </form>
</template>

<script>
export default {
    props: {
        product: { type: Object }
    },
    data() {
        return {
            form: { stock: this.product.stock, product_id: this.product.id },
            inventory: null
        };
    },
    created() {
        EventBus.$on(
            "selected-inventory",
            inventory => (this.inventory = iventonry.id)
        );
    },
    methods: {
        submit() {}
    }
};
</script>
