<template>
    <form @submit.prevent="submit">
        <input
            type="text"
            v-model="value"
            placeholder="Busca por el SKU ó Descripción"
            class="w-full  border-l-4  bg-gray border-purple-500 appearance-none py-5 sm:pl-64  mb-2 sm:mt-0 mt-2 leading-tight focus:outline-none mr-4 sm:text-center"
        />
    </form>
</template>
<script>
export default {
    data(){
        return {
            value:'',
        }
    },
    methods: 
    {
        submit()
        {
            console.log('submit..')
            EventBus.$emit("search-value-added",this.value);
        }
    }
};
</script>
