<template>
    <div class="flex justify-center">
        
    </div>
</template>
<script>
export default {
    props:{
        productsInPurchase:{
            type:Array
        }
    },
    data(){
        return{
            localProductsInPurchase:this.productsInPurchase
        }
    }
}
</script>