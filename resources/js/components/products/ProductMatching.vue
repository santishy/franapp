<template>
    <div >
        <product-card
            v-for="product in products" 
            :key="product.id"
            :product="product"
        >
        </product-card>
    </div>
</template>
<script>
import ProductCardComponent from './ProductCardComponent';
export default {
    data(){
        return{
            products:[]
        }
    },
    created(){
        EventBus.$on('matching-products',(obj) => {
            this.products = obj.products;
            console.log(obj.products)
        })
    },
    components:{
        'product-card' : ProductCardComponent
    }    
}
</script>