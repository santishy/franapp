<template>
    <div class="w-full px-4  flex justify-center bg-transparent">
        <form
            @submit.prevent="submit"
            class="w-full max-w-md shadow-lg rounded-lg bg-white px-6 py-8"
        >
            <div
                class="flex items-center py-2 text-dark text-center justify-center text-xl font-bold border-b border-teal-500"
            >
                Nuevo cliente
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
            <div class="flex items-center border-b border-teal-500 py-2">
                <input
                    v-model="form.phone_number"
                    name="phone_number"
                    class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
                    type="text"
                    placeholder="NUMERO DE TELEFONO"
                    aria-label="Full name"
                />
            </div>
            <div class="flex items-center border-b border-teal-500 py-2">
                <input
                    v-model="form.email"
                    name="email"
                    class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
                    type="email"
                    placeholder="EMAIL"
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
                    v-model="form.company"
                    name="distributor_price"
                    class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
                    type="text"
                    placeholder="EMPRESA O NEGOCIO"
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
    </div>
</template>

<script>
export default {
    data() {
        return {
            form: {},
            errors: null
        };
    },
    mounted() {
        if (!!this.client) {
            this.form = this.client;
        }
    },
    props: {
        method: {
            type: String,
            required: true
        },
        client: {
            type: Object
        }
    },
    methods: {
        submit() {
            var message = "EL cliente se creo correctamente";
            var url = "/clients";
            if (this.method == "put") {
                message = "El cliente se modifico correctamente";
                this.form._method = "put";
                url = `/clients/${this.client.id}`;
            }
            axios["post"](url, this.form)
                .then(res => {
                    this.$notify({
                        group: "foo",
                        title: "Clientes",
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
    }
};
</script>
