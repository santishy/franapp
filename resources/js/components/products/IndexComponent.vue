<template>
    <div class="grid  grid-cols-3 gap-4 mt-10">
        <product-card  v-for="product in products" :key="product.id" :product="product"/>
        <infinite-loading @infinite="getProducts"></infinite-loading>
    </div>
</template>
<script>
import ProductCardComponent from './ProductCardComponent.vue';
import InfiniteLoading from "vue-infinite-loading";
export default {
    data(){
        return {
            products:[],
            page:1
        }
    },
    components:{
        'product-card':ProductCardComponent,
        InfiniteLoading,
    },
    methods:{
        getProducts($state){
            axios.get('/products',{
                    params: {
                        page: this.page
                    }
                })
                .then((res)=>{
                   if (res.data.data.length) {
                        console.log(res.data.data.length)
                        this.page += 1;
                        this.products = this.products.concat(res.data.data);
                        $state.loaded();
                    } else {
                        $state.complete();
                    }
                })
                .catch((err) => {
                    console.log(err)
                })
        }
    }
}
</script>