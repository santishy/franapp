<template>
    <form @submit.prevent="submit">
        <div
            class="mt-2 flex  flex-wrap items-center justify-center bg-gray-200 px-2 py-4 rounded"
        >
            <p class="text-gray-700 mb-2 w-full col-span-2 flex-none">
                {{ product.description }}
            </p>

            <div class="w-1/3 flex-grow">
                <label> Cantidad </label>
            </div>
            <div class="w-2/3 flex-grow">
                <input
                    v-model="form.qty"
                    name="qty"
                    class="appearance-none bg-white border-gray-600 border-2 rounded-sm w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
                    type="number"
                    placeholder="Cantidad de venta"
                    aria-label="Full name"
                />
            </div>
            <div class="w-1/3 flex-grow mt-2">
                <label> Precio </label>
            </div>
            <div class="w-2/3 flex-grow mt-2">
                <input
                    v-model="form.sale_price"
                    name="qty"
                    class="appearance-none bg-white border-gray-600 border-2 rounded-sm w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
                    type="text"
                    placeholder="Precio de venta"
                    aria-label="Full name"
                />
            </div>
            <button
                class=" bg-red-300 mt-2 rounded transition-all duration-500 ease-in-out hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4 border-b-2 border-red-500 hover:border-transparent mr-1"
            >
                <i class="fas fa-minus-circle"></i>
            </button>
            <button
                type="submit"
                class=" bg-blue-300 mt-2 rounded transition-all duration-500 ease-in-out hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border-b-2 border-blue-500 hover:border-transparent w-2/3"
            >
                Modificar
            </button>
        </div>
    </form>
</template>

<script>
export default {
    props: {
        product: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            form: {}
        };
    },
    created() {
        this.form.qty = this.product.sale_quantity;
        this.form.sale_price = this.product.retail_price;
    },
    methods: {
        submit() {
            this.form._method = "put";
            this.form.product_id = this.product.id;
            axios
                .post(`/sales/${this.product.id}/products`,this.form)
                .then(res => {
                    console.log(res.data);
                })
                .catch(err => {
                    console.log(err);
                });
        }
    }
};
</script>
