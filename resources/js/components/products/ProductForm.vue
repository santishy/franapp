<template>
    <!-- <div class="w-full  flex justify-center mt-20 bg-transparent"> -->
        <form
            @submit.prevent="submit"
            class="w-full max-w-md shadow-lg rounded-lg bg-white md:px-6 md:py-8 md:mt-0 mt-10"
        >
            <div
                class="flex items-center py-2 text-dark text-center justify-center text-xl font-bold border-b border-teal-500"
            >
                Añadir producto
            </div>
            <div :class="hidden" class="flex items-center border-b border-teal-500 py-2 ">
                {{categoryName}}
                <input
                    v-model="this.form.category_id"
                    name="category_id"
                    :disabled="true"
                    class="appearance-none bg-gray-200 border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
                    type="hidden"
                    placeholder="Busca o agrega una categoría"
                    aria-label="Full name"
                />
            </div>
            <div class="flex items-center border-b border-teal-500 py-2">
                <input
                    v-model="form.sku"
                    name="sku"
                    class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
                    type="text"
                    placeholder="SKU"
                    aria-label="Full name"
                />
            </div>
            <div class="flex items-center border-b border-teal-500 py-2">
                <textarea
                    v-model="form.description"
                    name="description"
                    class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
                    type="text"
                    placeholder="DESCRIPCIÓN DEL PRODUCTO"
                    aria-label="Full name"
                >
                </textarea>
            </div>
            <div class="flex items-center border-b border-teal-500 py-2">
                <input
                    v-model="form.wholesale_price"
                    name="wholesale_price"
                    class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
                    type="text"
                    placeholder="PRECIO AL POR MAYOR"
                    aria-label="Full name"
                />
            </div>
            <div class="flex items-center border-b border-teal-500 py-2">
                <input
                    v-model="form.retail_price"
                    name="retail_price"
                    class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
                    type="text"
                    placeholder="PRECIO AL POR MENOR"
                    aria-label="Full name"
                />
            </div>
            <div
                :class="[
                    'flex',
                    'items-center',
                    'border-b',
                    this.errors ? 'border-transparent' : 'border-teal-500',
                    'py-2'
                ]"
            >
                <input
                    v-model="form.distributor_price"
                    name="distributor_price"
                    class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
                    type="text"
                    placeholder="PRECIO DISTRIBUIDOR"
                    aria-label="Full name"
                />
            </div>
            <div v-if="errors" class="flex items-center mb-3">
                <errors-component :errors="errors" />
            </div>

            <div class="flex justify-center mt-0 mb-0">
                <button
                    class="bg-transparent transition-all duration-500 ease-in-out hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border-b-2 border-blue-500 hover:border-transparent w-full"
                >
                    Guardar
                </button>
            </div>
            
            <notifications group="foo"></notifications>
        </form>
    <!-- </div> -->
</template>

<script>
export default {
    data() {
        return {
            form: {},
            errors: null,
            category_name:''
        };
    },
    mounted() {
        if (!!this.product) {
            this.form = this.product;
        }
        EventBus.$on('selected-category',category => {
            this.category_name = category.name;
            this.form.category_id = category.id;
        })
    },
    props: {
        method: {
            type: String
        },
        product: {
            type: Object
        }
    },
    methods: {
        submit() {
            var message = "EL producto se creo correctamente";
            var url = "/products";
            if (this.method == "put") {
                message = "El producto se modifico correctamente";
                this.form._method = "put";
                url = `/products/${this.product.id}`;
            }
            console.log(this.form);
            axios["post"](url, this.form)
                .then(res => {
                    this.$notify({
                        group: "foo",
                        title: "Productos",
                        text: message
                    });
                    if (this.method == "post") this.form = {};
                    this.errors = null;
                })
                .catch(err => {
                    this.errors = Object.values(
                        err.response.data.errors
                    ).flat();
                });
        }
    },
    computed:{
        categoryName(){
            return this.category_name;
        },
        hidden(){
            return this.form.category_id ? '' : 'hidden'
        }
    }
};
</script>
