<template>
    <form>
        <form class="block" @submit.prevent="submit">
            <input type="hidden" name="product_id" />
            <button
                class="bg-purple-500  w-full hover:bg-purple-700 text-white font-bold py-1 px-4 rounded text-2xl"
            >
                <i class="fas fa-shopping-cart"></i>
            </button>
        </form>
    </form>
</template>
<script>
import {mapState} from "vuex";
export default {
    props: {
        product: {
            type: Object
        }
    },
    methods: {
        submit() {
            console.log(this.product);
            axios
                .post(`/sales/${this.product.id}/products`,{salePriceOption:this.salePriceOption})
                .then(res => {
                    EventBus.$emit('product-added-sales-cart',res.data.transaction);
                })
                .catch(err => {
                    console.log(err);
                });
        }
    },
    computed:{
        ...mapState(['salePriceOption'])
    }
};
</script>
