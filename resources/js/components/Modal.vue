<template>
    <div>
        <button @click="toggleModal = !toggleModal">
            <list-icon></list-icon>
        </button>
        <div
            v-if="toggleModal"
            class="fixed modal max-h-full  overflow-x-hidden overflow-y-auto flex justify-center items-center z-50 shadow-2xl"
        >
            <div
                class="relative mx-auto max-w-6xl w-full shadow-2xl"
            >
                <div
                    class="bg-white w-full rounded shadow-2xl p-4 relative"
                >
                    <product-list :transactionType="transactionType" :products="products"></product-list>
                </div>
            </div>
        </div>

        <div
            v-if="toggleModal"
            @click="toggleModal = false"
            class="fixed inset-0 opacity-25 bg-black z-40"
        ></div>
    </div>
</template>
<script>
import ProductList from './reports/products/ProductList.vue';
import ListIcon from './icons/ListIcon.vue'
export default {

    props:{
        products:{
            type:Array,
        },
        transactionType:{
            type:String
        }
    },
    data: () => {
        return {
            toggleModal: false
        };
    },
    components:{ProductList,ListIcon}
};
</script>
<style scoped>
.modal {
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}
</style>
