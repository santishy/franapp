<template>
    <div class="">
        <form class="rounded bg-white shadow  p-4" @submit.prevent="submit">
            <div
                class="flex items-center py-2 text-dark text-center justify-center text-xl font-bold border-b border-teal-500"
            >
                Nuevo Role
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
        </form>
        <role-list class="mt-4" :roles="roles"></role-list>
    </div>
</template>

<script>
import RoleList from "./RoleList.vue";
import ErrorsComponent from "../ErrorsComponent";

export default {
    data: () => ({
        form: {}
    }),
    props: {
        roles: {
            type: Array 
            
        }
    },
    components: { ErrorsComponent },
    components: { RoleList },
    methods: {
        submit() {
            axios
                .post("/roles", this.form)
                .then(res => {
                    EventBus.$emit('role-created',res.data)
                })
                .catch(error => {
                    this.getErrors(error);
                });
        }
    }
};
</script>
