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
import {mapActions} from 'vuex';
export default {
    data(){
        return{
            sku:null,
        }
    },
    methods:{
        ...mapActions(['search']),
          handleSearh (e,page = 1){
            let obj = new Object();
            obj.sku = this.sku;
            obj.page = page;
            console.log(e);
            return new Promise((resolve,reject) => {
                this.search(obj)
                    .then ((res) => {
                        console.log(page)
                        if(page==1){
                            console.log('entro')
                            obj.products = res.data.data;
                            console.log(res)
                            EventBus.$emit('matching-products',obj);
                        }
                        else{
                            console.log('no entro')
                        }
                        
                       resolve(res)
                    })
                    .catch((err) => {
                        reject(err)
                    })
            });
            
        }
    }
}
</script>