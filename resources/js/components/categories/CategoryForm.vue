<template>
    <form
        @submit.prevent="submit"
        v-can="'create category'"
        class="w-full max-w-md shadow-lg rounded-lg bg-white md:px-6 md:py-8  md:mt-0"
    >
        <div
            class="flex items-center py-2 text-dark text-center justify-center text-xl font-bold border-b border-teal-500"
        >
            Añadir categoría
        </div>
        <div class="flex items-center border-b border-teal-500 py-2">
            <input
                v-model="form.name"
                name="name"
                class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
                :class="[
                    'flex',
                    'items-center',
                    'border-b',
                    this.errors ? 'border-transparent' : 'border-teal-500',
                    'py-2'
                ]"
                type="text"
                placeholder="CATEGORÍA"
                aria-label="Full name"
            />
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
    <!-- </div> -->
</template>
<script>
export default {
    data: () => ({
        form: {}
    }),
    props: {
        uri: {
            type: String
        }
    },
    created() {
        console.log(this.$parent.category)
        if (this.$parent.category) this.form = this.$parent.category;
    },
    methods: {
        submit() {
            if (this.$parent.method == "put") this.form._method = "put";
            axios
                .post(this.uri, this.form)
                .then(res => {
                    EventBus.$emit("category-created", res.data);
                    this.form = {};
                    let obj = {
                        message: "Categoría agregada",
                        title: "Categorías"
                    };
                    this.notify(obj);
                })
                .catch(err => {
                    this.getErrors(err);
                });
        }
    }
};
</script>
