<template>
    <form>
        <div class="flex items-center border-b border-teal-500 py-2">
            <input
                v-model="form.sku"
                name="sku"
                class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
                type="number"
                placeholder="Número del cliente"
                aria-label="Full name"
            />
        </div>
    </form>
</template>
<script>
export default {
    data(){
        return {
            form:{}
        }
    }
};
</script>
