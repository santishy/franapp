<template>
    <!-- <div class="w-full  flex justify-center mt-20 bg-transparent"> -->
    <nav-component>
        <div
            class="flex justify-center items-baseline flex-wrap px-4 w-9/12 mx-auto"
        >
            <form
                id="product-form"
                @submit.prevent="submit"
                v-can="definePermission"
                class="w-full  shadow-lg rounded-lg bg-white md:px-6 md:py-6  md:mt-0 mt-10 md:mb-0"
            >
                <div
                    class="flex items-center py-2 text-dark text-center justify-center text-xl font-bold "
                >
                    Nuevo producto
                </div>
                <div
                    class="flex items-center  border-t border-gray-500 py-2 relative"
                >
                    <select
                        name="category_id"
                        v-model="form.category_id"
                        plahceholder="Elige una categoria"
                        class="block appearance-none w-full bg-white hover:border-gray-500 px-4 pl-60 py-1 pr-8 rounded leading-tight focus:outline-none focus:shadow-outline"
                    >
                        <option disabled value="" selected class="text-gray-600"
                            >Seleccione un elemento</option
                        >
                        <option
                            v-for="category in categories"
                            :key="category.id"
                            :value="category.id"
                            >{{ category.name }}</option
                        >
                    </select>
                    <label
                        for=""
                        class="absolute  pl-0 bg-gray-200 h-full flex items-center w-56 justify-center text-indigo-800 font-mono"
                        >Categoría</label
                    >
                </div>
                <div
                    class="flex items-center  border-t border-gray-500 py-2 relative"
                >
                    <input
                        type="file"
                        name="image"
                        @change="onFileSelected"
                        class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 pl-60 leading-tight focus:outline-none"
                        placeholder="Subir imagen"
                        aria-label="Full name"
                    />
                    <label
                        for=""
                        class="absolute  pl-0 bg-gray-200 h-full flex items-center w-56 justify-center text-indigo-800 font-mono"
                        >Imagen</label
                    >
                </div>
                <div
                    class="flex items-center  border-t border-gray-500 py-2 relative"
                >
                    <input
                        v-model="form.sku"
                        name="sku"
                        class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 pl-60 leading-tight focus:outline-none"
                        type="text"
                        placeholder="SKU"
                        aria-label="Full name"
                    />
                    <label
                        for=""
                        class="absolute  pl-0 bg-gray-200 h-full flex items-center w-56 justify-center text-indigo-800 font-mono"
                        >SKU</label
                    >
                </div>
                <div
                    class="flex items-center  border-t border-gray-500 py-2 relative"
                >
                    <textarea
                        v-model="form.description"
                        name="description"
                        class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 pl-60 leading-tight focus:outline-none"
                        type="text"
                        placeholder="DESCRIPCIÓN DEL PRODUCTO"
                        aria-label="Full name"
                    >
                    </textarea>
                    <label
                        for=""
                        class="absolute  pl-0 bg-gray-200 h-full flex items-center w-56 justify-center text-indigo-800 font-mono"
                        >Descripción</label
                    >
                </div>
                <div
                    class="flex items-center  border-t border-gray-500 py-2 relative"
                >
                    <input
                        v-model="form.wholesale_price"
                        name="wholesale_price"
                        class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 pl-60 leading-tight focus:outline-none"
                        type="text"
                        placeholder="PRECIO AL POR MAYOR"
                        aria-label="Full name"
                    />
                    <label
                        for=""
                        class="absolute text-center pl-0 bg-gray-200 h-full flex items-center w-56 justify-center text-indigo-800 font-mono"
                        >Precio al por mayor</label
                    >
                </div>
                <div
                    class="flex items-center border-b border-t border-gray-500 py-2 relative"
                >
                    <input
                        v-model="form.retail_price"
                        name="retail_price"
                        class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 pl-60 leading-tight focus:outline-none"
                        type="text"
                        placeholder="PRECIO AL POR MENOR"
                        aria-label="Full name"
                    />
                    <label
                        for=""
                        class="absolute text-center pl-0 bg-gray-200 h-full flex items-center w-56 justify-center text-indigo-800 font-mono"
                        >Precio al por menor</label
                    >
                </div>
                <div
                    :class="[
                        'flex relative',
                        'items-center',
                        'border-b',
                        this.errors ? 'border-transparent' : 'border-gray-500',
                        'py-2'
                    ]"
                >
                    <input
                        v-model="form.distributor_price"
                        name="distributor_price"
                        class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 pl-60 leading-tight focus:outline-none"
                        type="text"
                        placeholder="PRECIO PROVEEDOR"
                        aria-label="Full name"
                    />
                    <label
                        for=""
                        class="absolute text-center pl-0 bg-gray-200 h-full flex items-center w-56 justify-center text-indigo-800 font-mono"
                        >Precio proveedor</label
                    >
                </div>
                <div class="flex items-center ">
                    <errors-component :errors-found="errors" />
                </div>

                <div class="flex justify-center mt-0 mb-0">
                    <button
                        class="bg-transparent transition-all duration-500 ease-in-out hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border-b-2 border-blue-500 hover:border-transparent w-full"
                    >
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </nav-component>
</template>

<script>
import NavComponent from "../NavComponent.vue";

export default {
    components: {
        NavComponent
    },
    data() {
        return {
            form: {
                category_id: ""
            },
            category_name: ""
        };
    },
    mounted() {
        if (!!this.product) {
            this.form = this.product;
        }
    },
    props: {
        method: {
            type: String,
            required: true
        },
        product: {
            type: Object
        },
        categories: {
            type: Array
        }
    },
    methods: {
        async submit() {
            let message = { message: "EL producto se creo correctamente" };
            var url = "/products";
            var formData = new FormData(document.querySelector('#product-form'));

            if (this.method == "put") {
                message = { message: "El producto se modifico correctamente" };
                formData.append('_method' , "put");
                formData.append('id',this.product.id);
                url = `/products/${this.product.id}`;
            }
            axios["post"](url,formData, {
                headers: {
                    "Content-Type": "multipart/form-data",
                    'Accept': 'application/json',
                }
            })
                .then(res => {
                    let obj = { title: "Productos", ...message };
                    console.log(obj);
                    this.notify(obj);
                    if (this.method == "post") this.form = {};
                    this.errors = null;
                })
                .catch(err => {
                    this.getErrors(err);
                });
        },
        onFileSelected(event) {
            this.form.image = event.target.files[0];
        }
    },
    computed: {
        categoryName() {
            return this.category_name;
        },
        hidden() {
            return this.form.category_id ? "" : "hidden";
        },
        definePermission() {
            if (this.method.toUpperCase() === "POST") return "create product";
            return "edit product";
        }
    }
};
</script>
