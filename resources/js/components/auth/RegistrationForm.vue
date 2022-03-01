<template>
    <form
        @submit.prevent="submit"
        v-can="definePermission"
        class="shadow-sm rounded-sm bg-white"
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
            {{ getTitle }}
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
            <select
                v-model="form.inventory_id"
                name="inventory_id"
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
                placeholder="Nombre completo"
                aria-label="Full name"
            >
                <option value="" disabled selected>Elige un almacén</option>
                <option
                    v-for="inventory in inventories"
                    :key="inventory.id"
                    :value="inventory.id"
                >
                    {{ inventory.name }}
                </option>
            </select>
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
                >Almacenes</label
            >
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
                placeholder="Nombre completo"
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
                v-model="form.email"
                name="email"
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
                type="email"
                placeholder="Correo electronico"
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
                >Email</label
            >
        </div>
        <div
            v-if="!editableUser"
            class="
                flex flex-col-reverse
                px-2
                sm:px-0 sm:flex-row sm:items-center sm:border-b sm:border-t
                border-gray-300
                sm:py-2 sm:relative
            "
        >
            <input
                v-model="form.password"
                name="password"
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
                type="password"
                placeholder="Contraseña"
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
                >Contraseña</label
            >
        </div>
        <div
            v-if="!editableUser"
            class="
                flex flex-col-reverse
                px-2
                sm:px-0 sm:flex-row sm:items-center sm:border-b sm:border-t
                border-gray-300
                sm:py-2 sm:relative
            "
        >
            <input
                v-model="form.password_confirmation"
                name="password_confirmation"
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
                type="password"
                placeholder="Confirmar contraseña"
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
                >Confirmar Contraseña</label
            >
        </div>
        <div class="flex items-center">
            <errors-component :errors-found="errors" />
        </div>

        <div class="flex justify-center mt-0 mb-0">
            <button
                class="
                    mt-4 
                    sm:mt-0
                    bg-blue-500
                    transition-all
                    duration-500
                    ease-in-out
                    hover:bg-blue-700
                    text-gray-100
                    font-semibold
                    hover:text-white
                    py-2
                    px-4
                    border-b-2 border-blue-500
                    hover:border-transparent
                    w-full
                "
            >
                {{ getButtonTitle }}
            </button>
        </div>
    </form>
</template>
<script>
export default {
    props: {
        editableUser: {
            type: Object,
        },
        inventories: {
            type: Array,
        },
        uri: {
            type: String,
            required: true,
        },
        method: {
            type: String,
            required: true,
        },
    },
    data: () => ({
        form: {
            inventory_id: "",
        },
        roles: [],
        obj: {
            title: "Usuarios",
        },
    }),
    created() {
        EventBus.$on("assign-role", (role) => {
            this.roles.push(role);
        });
        EventBus.$on("remove-role", (role) => {
            let index = this.roles.indexOf(role);
            this.roles.splice(index, 1);
        });
        if (this.editableUser) {
            this.form = this.editableUser;
            this.editableUser.roles.map(({ id }) => {
                this.roles.push(id);
            });
        }
    },
    methods: {
        submit() {
            this.form.roles = this.roles;
            this.form._method = this.method;
            axios["post"](this.uri, this.form)
                .then((res) => {
                    if (this.method == "post") {
                        this.form = { inventory_id: "" };
                        this.obj.message = "Usuario agregado correctamente.";
                    } else {
                        this.obj.message = "Usuario modificado correctamente";
                    }
                    this.notify(this.obj);
                })
                .catch((err) => {
                    this.getErrors(err);
                });
        },
    },
    computed: {
        getTitle() {
            return !!this.editableUser ? "Modificar usuario" : "Nuevo usuario";
        },
        getButtonTitle() {
            return !!this.editableUser ? "Editar" : "Guardar";
        },
        definePermission() {
            if (this.method.toUpperCase() === "POST") return "create user";
            return "edit user";
        },
    },
};
</script>
