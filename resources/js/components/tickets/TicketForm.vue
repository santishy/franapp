<template>
    <layout-component>
        <div class="w-full px-4  flex justify-center bg-transparent">
            <form @submit.prevent="submit" class="w-full  shadow-sm rounded-sm bg-white">
                <div class="form-header p-2 text-dark text-center  text-xl font-extralight text-blue-800">
                    Modificar contenido del ticket
                </div>
                <div
                    class="flex flex-col-reverse px-2 sm:px-0 sm:flex-row sm:items-center sm:border-b sm:border-t border-gray-300 sm:py-2 sm:relative">
                    <input v-model="form.company" name="companty"
                        class="appearance-none  sm:shadow-none static sm:p-0 p-2 bg-gray-200 sm:bg-transparent border-none w-full text-gray-700 mr-3 sm:py-1 sm:pr-2 sm:pl-56 leading-tight focus:outline-none"
                        type="text" placeholder="COMPAÑIA" aria-label="Full name" />
                    <label for=""
                        class="sm:absolute pl-2  sm:pl-0 sm:p-0 p-2 sm:bg-gray-200 h-full flex items-center sm:w-52 sm:justify-center text-indigo-800 font-mono">Compañia</label>
                </div>
                <div
                    class="flex flex-col-reverse px-2 sm:px-0 sm:flex-row sm:items-center sm:border-b sm:border-t border-gray-300 sm:py-2 sm:relative">
                    <input v-model="form.address" name="address"
                        class="appearance-none  sm:shadow-none static sm:p-0 p-2 bg-gray-200 sm:bg-transparent border-none w-full text-gray-700 mr-3 sm:py-1 sm:pr-2 sm:pl-56 leading-tight focus:outline-none"
                        type="text" placeholder="DIRECCION" aria-label="Full name" />
                    <label for=""
                        class="sm:absolute pl-2  sm:pl-0 sm:p-0 p-2 sm:bg-gray-200 h-full flex items-center sm:w-52 sm:justify-center text-indigo-800 font-mono">Dirección</label>
                </div>
                <div
                    class="flex flex-col-reverse px-2 sm:px-0 sm:flex-row sm:items-center sm:border-b sm:border-t border-gray-300 sm:py-2 sm:relative">
                    <input v-model="form.city" name="address"
                        class="appearance-none  sm:shadow-none static sm:p-0 p-2 bg-gray-200 sm:bg-transparent border-none w-full text-gray-700 mr-3 sm:py-1 sm:pr-2 sm:pl-56 leading-tight focus:outline-none"
                        type="text" placeholder="CIUDAD" aria-label="Full name" />
                    <label for=""
                        class="sm:absolute pl-2  sm:pl-0 sm:p-0 p-2 sm:bg-gray-200 h-full flex items-center sm:w-52 sm:justify-center text-indigo-800 font-mono">Ciudad</label>
                </div>
                <div
                    class="flex flex-col-reverse px-2 sm:px-0 sm:flex-row sm:items-center sm:border-b sm:border-t border-gray-300 sm:py-2 sm:relative">
                    <input v-model="form.postal_code" name="address"
                        class="appearance-none  sm:shadow-none static sm:p-0 p-2 bg-gray-200 sm:bg-transparent border-none w-full text-gray-700 mr-3 sm:py-1 sm:pr-2 sm:pl-56 leading-tight focus:outline-none"
                        type="text" placeholder="CODIGO POSTAL" aria-label="Full name" />
                    <label for=""
                        class="sm:absolute pl-2  sm:pl-0 sm:p-0 p-2 sm:bg-gray-200 h-full flex items-center sm:w-52 sm:justify-center text-indigo-800 font-mono">Codigo
                        Postal</label>
                </div>
                <div
                    class="flex flex-col-reverse px-2 sm:px-0 sm:flex-row sm:items-center sm:border-b sm:border-t border-gray-300 sm:py-2 sm:relative">
                    <input v-model="form.phone_number" name="phone_number"
                        class="appearance-none  sm:shadow-none static sm:p-0 p-2 bg-gray-200 sm:bg-transparent border-none w-full text-gray-700 mr-3 sm:py-1 sm:pr-2 sm:pl-56 leading-tight focus:outline-none"
                        type="text" placeholder="NUMERO DE TELEFONO" aria-label="Full name" />
                    <label for=""
                        class="sm:absolute pl-2  sm:pl-0 sm:p-0 p-2 sm:bg-gray-200 h-full flex items-center sm:w-52 sm:justify-center text-indigo-800 font-mono">Telefono</label>
                </div>
                <div
                    class="flex flex-col-reverse px-2 sm:px-0 sm:flex-row sm:items-center sm:border-b sm:border-t border-gray-300 sm:py-2 sm:relative">
                    <input v-model="form.whatsapp" name="address"
                        class="appearance-none  sm:shadow-none static sm:p-0 p-2 bg-gray-200 sm:bg-transparent border-none w-full text-gray-700 mr-3 sm:py-1 sm:pr-2 sm:pl-56 leading-tight focus:outline-none"
                        type="text" placeholder="WHATSAPP" aria-label="Full name" />
                    <label for=""
                        class="sm:absolute pl-2  sm:pl-0 sm:p-0 p-2 sm:bg-gray-200 h-full flex items-center sm:w-52 sm:justify-center text-indigo-800 font-mono">Whatsapp</label>
                </div>
                <div
                    class="flex flex-col-reverse px-2 sm:px-0 sm:flex-row sm:items-center sm:border-b sm:border-t border-gray-300 sm:py-2 sm:relative">
                    <textarea v-model="form.footer" name="footer" rows="5"
                        class="appearance-none  sm:shadow-none static sm:p-0 p-2 bg-gray-200 sm:bg-transparent border-none w-full text-gray-700 mr-3 sm:py-1 sm:pr-2 sm:pl-56 leading-tight focus:outline-none"
                        type="text" placeholder="PIE DE PAGINA" aria-label="Full name" />
                    <label for=""
                        class="sm:absolute pl-2  sm:pl-0 sm:p-0 p-2 sm:bg-gray-200 h-full flex items-center sm:w-52 sm:justify-center text-indigo-800 font-mono">Pie
                        de pagina</label>
                </div>
                <div class="flex items-center ">
                    <errors-component :errors-found="errors" />
                </div>

                <div class="flex justify-center mt-4 sm:mt-0 mb-0">
                    <button
                        class="bg-blue-500 transition-all duration-500 ease-in-out hover:bg-blue-700 text-white font-semibold hover:text-white py-2 px-4 border-b-2 border-blue-500 hover:border-transparent w-full">
                        Guardar
                    </button>
                </div>
                <notifications group="foo"></notifications>
            </form>
        </div>
    </layout-component>
</template>

<script>

export default {
    created() {
        this.form = this.ticket;
    },
    props: {
        ticket: {
            type: Object
        }
    },
    data() {
        return {
            form: {},
            errors: null,
            obj: { title: "Tickets" }
        };
    },
    methods: {
        submit() {
            this.obj.message = "EL ticket se modifico correctamente";
            this.form._method = 'put';
            axios["post"](`/tickets/${this.ticket.id}`, this.form)
                .then(res => {
                    this.notify(this.obj);
                    this.errors = null;
                })
                .catch(err => {
                    this.getErrors(err);
                });
        }
    }
};
</script>
