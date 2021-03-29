<template>
    <form
        @submit.prevent="submit"
        class="w-full max-w-md shadow-lg rounded-lg bg-white md:px-6 md:py-8 md:mt-32 mt-24"
    >
        <div
            class="flex items-center py-2 text-dark text-center justify-center text-xl font-bold border-b border-teal-500"
        >
            Registrar usuario
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
        <div class="flex items-center border-b border-teal-500 py-2">
            <input
                v-model="form.password"
                name="password"
                class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
                type="password"
                placeholder="Contraseña"
                aria-label="Full name"
            />
        </div>
        <div class="flex items-center border-b border-teal-500 py-2">
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
                Guardar
            </button>
        </div>
    </form>
    <!--<form
        @submit.prevent="submit"
        class="w-4/12 mx-auto bg-white rounded shadow-md px-4 py-2 mt-24 md:mt-32"
    >
        <div class="mb-4">
            <h3 class="text-xl">Registrar</h3>
        </div>
        <div class="mb-4">
            <label
                class="block text-gray-700 text-sm font-bold mb-2"
                for="username"
            >
                Nombre
            </label>
            <input
                name="name"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="name"
                v-model="form.name"
                type="text"
                placeholder="example@test.com"
            />
        </div>
        <div class="mb-4">
            <label
                class="block text-gray-700 text-sm font-bold mb-2"
                for="username"
            >
                Email
            </label>
            <input
                name="email"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="email"
                v-model="form.email"
                type="text"
                placeholder="example@test.com"
            />
        </div>
        <div class="mb-4">
            <label
                class="block text-gray-700 text-sm font-bold mb-2"
                for="username"
            >
                Password
            </label>
            <input
                name="password"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="password"
                type="password"
                placeholder="example@test.com"
            />
        </div>

        <div class="mb-4">
            <label
                class="block text-gray-700 text-sm font-bold mb-2"
                for="username"
            >
                Confirma Password
            </label>
            <input
                name="password_confirmation"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="password_confirmation"
                type="password"
                placeholder="example@test.com"
            />
        </div>
        <button
            class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded"
        >
            Guardar
        </button>
    </form>-->
</template>
<script>
import Errors from '../../mixins/Errors';
export default {
    mixins:[Errors],
    data: () => ({
        form: {},
        roles:[]
    }),
    created(){
        EventBus.$on('assign-role',role => {
            this.roles.push(role);
        });
        EventBus.$on('remove-role',role => {
            let index = this.roles.indexOf(role)
            this.roles.splice(index,1);
        })
    },
    methods: {
        submit() {
            this.form.roles = this.roles;
            axios.post('/register',this.form)
                .then( res => {
                    console.log(res)
                })
                .catch( err => {
                    this.getErrors(err)
                })
        }
    }
};
</script>
