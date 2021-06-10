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
        <div class="flex items-center border-b border-teal-500 py-2">
            <select
                name="category_id"
                v-model="form.category_id"
                plahceholder="Elige una categoria"
                class="block appearance-none w-full bg-white hover:border-gray-500 px-4 py-2 pr-8 rounded leading-tight focus:outline-none focus:shadow-outline"
            >
                <option disabled value="" selected>Seleccione un elemento</option>
                <option v-for="category in categories" :key="category.id" :value="category.id">{{category.name}}</option>
            </select>
            <div
                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700"
            >
                <svg
                    class="fill-current h-4 w-4"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20"
                >
                    <path
                        d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"
                    />
                </svg>
            </div>
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
            <errors-component :errors-found="errors" />
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
// import Errors from '../../mixins/Errors';
export default {
    // mixins:[Errors],
    data() {
        return {
            form: {
                category_id:''
            },
            category_name: ""
        };
    },
    mounted() {
        if (!!this.product) {
            this.form = this.product;
        }
        // EventBus.$on("selected-category", category => {
        //     this.category_name = category.name;
        //     this.form.category_id = category.id;
        // });
    },
    props: {
        method: {
            type: String
        },
        product: {
            type: Object
        },
        categories:{
            type:Array
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
                    this.getErrors(err);
                });
        }
    },
    computed: {
        categoryName() {
            return this.category_name;
        },
        hidden() {
            return this.form.category_id ? "" : "hidden";
        }
    }
};
</script>
