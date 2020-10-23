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
import { mapActions } from "vuex";
export default {
    data() {
        return {
            sku: null
        };
    },
    methods: {
        ...mapActions(["search"]),
        // handleSearh(e, page = 1) {
        //     let obj = new Object();
        //     obj.sku = this.sku;
        //     obj.page = page;
           
        //     return EventBus.$emit("matching-products", obj);
        
        //     return new Promise((resolve, reject,obj) => {
        //         console.log('entro a promesa'+this.sku)
        //         this.search(obj)
        //             .then(res => {
        //                 if (page == 1) {
        //                     obj.products = res.data.data;
        //                     EventBus.$emit("matching-products", obj);
        //                 }
        //                 resolve(res);
        //             })
        //             .catch(err => {
        //                 reject(err);
        //             });
        //     });
        // }
    }
};
</script>
