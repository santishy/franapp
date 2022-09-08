<template>
    <nav-component>
        <div class="w-full px-4 flex justify-center bg-transparent">
            <form
                @submit.prevent="submit"
                v-can="definePermission"
                class="w-full shadow-sm rounded-sm bg-white"
            >
                <div
                    class="
                        flex
                        items-center
                        py-2
                        text-blue-800
                        form-header
                        text-dark text-center
                        justify-center
                        text-xl
                        font-extralight
                    "
                >
                    {{ getTitle }}
                </div>
                <div
                    class="
                        flex flex-col-reverse
                        px-2
                        sm:px-0
                        sm:flex-row
                        sm:items-center
                        sm:border-b
                        sm:border-t
                        border-gray-300
                        sm:py-2 sm:relative
                    "
                >
                    <input
                        v-model="form.phone_number"
                        name="phone_number"
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
                        @keyup="searchPhoneNumber"
                        type="text"
                        placeholder="NUMERO DE TELEFONO"
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
                        >Telefono</label
                    >
                </div>
                <div
                    class="
                        flex flex-col-reverse
                        px-2
                        sm:px-0
                        sm:flex-row
                        sm:items-center
                        sm:border-b
                        sm:border-t
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
                <div
                    class="
                        flex flex-col-reverse
                        px-2
                        sm:px-0
                        sm:flex-row
                        sm:items-center
                        sm:border-b
                        sm:border-t
                        border-gray-300
                        sm:py-2 sm:relative
                    "
                >
                    <input
                        v-model="form.address"
                        name="address"
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
                        placeholder="DIRECCION"
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
                        >Dirección</label
                    >
                </div>
                
                <div
                    class="
                        flex flex-col-reverse
                        px-2
                        sm:px-0
                        sm:flex-row
                        sm:items-center
                        sm:border-b
                        sm:border-t
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
                        placeholder="EMAIL"
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
                    class="
                        flex flex-col-reverse
                        px-2
                        sm:px-0
                        sm:flex-row
                        sm:items-center
                        sm:border-b
                        sm:border-t
                        border-gray-300
                        sm:py-2 sm:relative
                    "
                >
                    <select
                        name="assigned_price"
                        v-model="form.assigned_price"
                        plahceholder="Asigna un precio al cliente"
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
                    >
                        <option
                            disabled
                            value=""
                            selected
                            class="text-gray-600"
                        >
                            Asignar un precio
                        </option>
                        <option value="retail_price">
                            Precio al por menor
                        </option>
                        <option value="wholesale_price">
                            Precio al por mayor
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
                        >Precio asignado</label
                    >
                </div>
                <div
                    class="
                        flex flex-col-reverse
                        px-2
                        sm:px-0
                        sm:flex-row
                        sm:items-center
                        sm:border-b
                        sm:border-t
                        border-gray-300
                        sm:py-2 sm:relative
                    "
                    :class="[
                        this.errors ? 'border-transparent' : 'border-gray-300',
                        'py-2',
                    ]"
                >
                    <input
                        v-model="form.company"
                        name="distributor_price"
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
                        placeholder="EMPRESA O NEGOCIO"
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
                        >Empresa</label
                    >
                </div>
                <div class="flex items-center">
                    <errors-component :errors-found="errors" />
                </div>

                <div class="flex justify-center mt-0 mb-0">
                    <button
                        class="
                            mt-2
                            sm:mt-0
                            bg-transparent
                            transition-all
                            duration-500
                            ease-in-out
                            hover:bg-blue-700
                            text-white
                            bg-blue-500
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
        </div>
    </nav-component>
</template>

<script>
import NavComponent from "../NavComponent.vue";
export default {
    components: { NavComponent },
    data() {
        return {
            form: { assigned_price: "" },
            errors: null,
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
            required: true,
        },
        client: {
            type: Object,
        },
    },
    methods: {
        async searchPhoneNumber(){
            if(this.form?.phone_number.length === 10){
                axios.get('/clients/' + this.form.phone_number)
                    .then( res => {
                        console.log(res)
                    })
                    .catch(e)
                    {
                        console.log(e.message)
                    };

            }
        },
        submit() {
            var obj = {
                title: "Clientes",
                message: "EL cliente se creo correctamente",
            };
            var url = "/clients";
            if (this.method == "put") {
                obj.message = "El cliente se modifico correctamente";
                this.form._method = "put";
                url = `/clients/${this.client.phone_number}`;
            }
            axios["post"](url, this.form)
                .then((res) => {
                    this.notify(obj);
                    if (this.method == "post") this.form = {};
                    this.errors = null;
                })
                .catch((err) => {
                    this.getErrors(err);
                });
        },
    },
    computed: {
        definePermission() {
            if (this.method.toUpperCase() === "POST") return "create client";
            return "edit client";
        },
        getTitle() {
            if (this.method.toUpperCase() === "POST") return "Nuevo cliente";
            return "Modificar cliente";
        },
    },
};
</script>
