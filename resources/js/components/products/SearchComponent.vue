<template>
    <input
        type="text"
        v-model="sku"
        v-on:keyup.enter="handleSearh"
        placeholder="Busca por el SKU del producto"
        class="shadow  appearance-none py-5 px-4 rounded leading-tight focus:outline-none focus:shadow-outline"
    />
</template>
<script>
export default {
    data(){
        return{
            sku:null,
        }
    },
    methods:{
        handleSearh(){
            const search = new Promise((resolve,reject) => {
                this.search()
                    .then ((res) => {
                        resolve(res)
                    })
                    .catch((err) => {
                        reject(err)
                    })
            });
            EventBus.$emit('matching-products',search);
        }
    }
}
</script>