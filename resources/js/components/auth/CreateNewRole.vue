<template>
    <div class="">
        <form
            class="rounded-sm bg-white shadow mt-4 sm:mt-0"
            @submit.prevent="submit"
            v-can="'create role'"
        >
            <div
                class="
                    form-header
                    p-2
                    text-dark text-center text-xl
                    font-extralight
                    text-blue-800
                "
            >
                Nuevo Role
            </div>
            <div
                class="
                    flex flex-col-reverse
                    px-2
                    sm:px-0 sm:flex-row sm:items-center sm:border-b sm:border-t
                    border-gray-300
                    sm:py-2 sm:relative
                "
            >
                <input
                    v-model="form.name"
                    name="name"
                    class="
                        appearance-none
                        sm:shadow-none
                        static
                        sm:p-0
                        p-2
                        bg-gray-200
                        sm:bg-transparent
                        border-none
                        w-full
                        text-gray-700
                        mr-3
                        sm:py-1 sm:pr-2 sm:pl-56
                        leading-tight
                        focus:outline-none
                    "
                    type="text"
                    placeholder="NOMBRE"
                    aria-label="Full name"
                />
                <label
                    for=""
                    class="
                        sm:absolute
                        pl-2
                        sm:pl-0 sm:p-0
                        p-2
                        sm:bg-gray-200
                        h-full
                        flex
                        items-center
                        sm:w-52 sm:justify-center
                        text-indigo-800
                        font-mono
                    "
                    >Nombre</label
                >
            </div>
            <div class="flex items-center">
                <errors-component :errors-found="errors" />
            </div>
            <div class="flex justify-center mt-4 sm:mt-0 mb-0">
                <button
                    class="
                        bg-blue-500
                        transition-all
                        duration-500
                        ease-in-out
                        hover:bg-blue-500
                        text-white
                        font-semibold
                        hover:text-white
                        py-2
                        px-4
                        border-b-2 border-blue-500
                        hover:border-transparent
                        w-full
                    "
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
        form: {},
        obj: { title: "Roles", message: "Rol creado correctamente." },
    }),
    props: {
        roles: {
            type: Array,
        },
    },
    components: { ErrorsComponent },
    components: { RoleList },
    methods: {
        submit() {
            axios
                .post("/roles", this.form)
                .then((res) => {
                    this.notify(this.obj);
                    EventBus.$emit("role-created", res.data);
                })
                .catch((error) => {
                    this.getErrors(error);
                });
        },
    },
};
</script>
