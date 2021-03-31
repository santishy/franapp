<template>
    <form
        @submit.prevent="submit"
        class="w-full max-w-md shadow-lg rounded-lg bg-white md:px-6 md:py-8 md:mt-32 mt-24"
    >
        <div
            class="flex items-center py-2 text-dark text-center justify-center text-xl font-bold border-b border-teal-500"
        >
            {{ getTitle }}
        </div>
        <div class="flex items-center border-b border-teal-500 py-2">
            <input
                v-model="form.name"
                name="name"
                class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
                type="text"
                placeholder="Nombre completo"
                aria-label="Full name"
            />
        </div>
        <div class="flex items-center border-b border-teal-500 py-2">
            <input
                v-model="form.email"
                name="email"
                class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
                type="email"
                placeholder="Correo electronico"
                aria-label="Full name"
            />
        </div>
        <div
            v-if="!user"
            class="flex items-center border-b border-teal-500 py-2"
        >
            <input
                v-model="form.password"
                name="password"
                class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
                type="password"
                placeholder="Contraseña"
                aria-label="Full name"
            />
        </div>
        <div
            v-if="!user"
            class="flex items-center border-b border-teal-500 py-2"
        >
            <input
                v-model="form.password_confirmation"
                name="password_confirmation"
                class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
                type="password"
                placeholder="Confirmar contraseña"
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
                {{getButtonTitle}}
            </button>
        </div>
    </form>
</template>
<script>
import Errors from "../../mixins/Errors";
export default {
    mixins: [Errors],
    props: {
        user: {
            type: Object
        },
        uri: {
            type: String,
            required: true
        },
        method: {
            type: String,
            required: true
        }
    },
    data: () => ({
        form: {},
        roles: []
    }),
    created() {
        EventBus.$on("assign-role", role => {
            this.roles.push(role);
        });
        EventBus.$on("remove-role", role => {
            let index = this.roles.indexOf(role);
            this.roles.splice(index, 1);
        });
        if (this.user) {
            this.form = this.user;
            this.user.roles.map(({ id }) => {
                this.roles.push(id);
            });
        }
    },
    methods: {
        submit() {
            this.form.roles = this.roles;
            this.form._method = this.method;
            axios["post"](this.uri, this.form)
                .then(res => {
                    console.log(res);
                })
                .catch(err => {
                    this.getErrors(err);
                });
        }
    },
    computed: {
        getTitle() {
            return !!this.user ? "Editar usuario" : "Requistrar usuario";
        },
        getButtonTitle() {
            return !!this.user ? "Editar" : "Guardar";
        }
    }
};
</script>
