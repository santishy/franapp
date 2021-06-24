<template>
    <nav-component>
    <div class="w-full px-4  flex justify-center bg-transparent md:mt-32 mt-24">
        <form
            @submit.prevent="submit"
            class="w-full max-w-md shadow-lg rounded-lg bg-white px-6 py-8"
        >
            <div
                class="flex items-center py-2 text-dark text-center justify-center text-xl font-bold border-b border-teal-500"
            >
                Nuevo Almacen
            </div>
            <div class="flex items-center border-b border-teal-500 py-2">
                <input
                    v-model="form.name"
                    name="name"
                    class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
                    type="text"
                    placeholder="NOMBRE"
                    aria-label="Full name"
                />
            </div>
            <div class="flex items-center border-b border-teal-500 py-2">
                <input
                    v-model="form.address"
                    name="address"
                    class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
                    type="text"
                    placeholder="DIRECCION"
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
    </div>
    </nav-component>
</template>

<script>
import NavComponent from "../NavComponent.vue";

export default {
  components: { NavComponent },
    data() {
        return {
            form: {},
            errors: null
        };
    },
    methods: {
        submit() {
            var message = "EL almacen se creo correctamente";
            var url = "/inventories";
            axios["post"](url, this.form)
                .then(res => {
                    this.$notify({
                        group: "foo",
                        title: "Almacenes",
                        text: message
                    });
                    this.form = {};
                    this.errors = null;
                })
                .catch(err => {
                    this.getErrors(err)
                });
        }
    }
};
</script>