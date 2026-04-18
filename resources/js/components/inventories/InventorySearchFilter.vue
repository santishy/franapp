<template>
    <form @submit.prevent="submit" class="w-full flex justify-end">
        <input type="text" v-model="value" placeholder="Busca por el SKU ó Descripción"
            class="w-full sm:w-3/5 shadow-sm border-l-4  border-[#0098D9] appearance-none py-2  sm:mt-1 mt-1 leading-tight focus:outline-none sm:text-center" />
    </form>
</template>
<script>
export default {
    data() {
        return {
            value: '',
        }
    },
    methods:
    {
        submit() {
            console.log('submit..')
            EventBus.$emit("search-value-added", this.value);
        }
    }
};
</script>
