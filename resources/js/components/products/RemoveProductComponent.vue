<template>
    <button
        @click="deleteProduct"
        class="bg-red-500 hover:bg-red-400 text-white font-bold py-2 px-4  hover:border-red-500 rounded"
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
