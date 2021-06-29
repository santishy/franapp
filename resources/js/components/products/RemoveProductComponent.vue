<template>
    <button
        @click="deleteProduct"
        class="text-red-500 hover:text-red-700 shadow-xs border-b-2 border-t-2 border-red-500 font-bold py-2  hover:border-red-700 rounded"
    >
        <i class="far fa-trash-alt"></i>
    </button>
</template>
<script>
export default {
    props:{
        product:{
            type:Object
        },
        index:{
            type:Number
        }
    },
    methods: {
        deleteProduct() {
            axios
                .delete(`/products/${this.product.id}`)
                .then((res)=>{
                    if(res.data){
                        EventBus.$emit('product-removed',this.index)
                    }
                })
                .catch((err) => {
                    console.log(err)
                })
        }
    }
};
</script>
