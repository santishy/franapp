<template>
    <div class="w-full  flex justify-center mt-20 bg-transparent">
        <form
            @submit.prevent="submit"
            class="w-full max-w-md shadow-lg rounded-lg bg-white px-6 py-8"
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
                <div v-if="errors" class="flex items-center mb-3">
                    <errors-component :errors="errors" />
                </div>
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
    data: () => ({
        form: {},
        errors: null
    })
};
</script>
