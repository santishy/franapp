<template>
    <form @submit.prevent="submit">
        <input type="hidden" name="product_id" />
        <button
            class="bg-purple-500 border-purple-900 border-b-4 hover:bg-purple-700 text-white font-bold py-1 px-4 rounded-full text-2xl"
        >
            C
        </button>
    </form>
</template>
<script>
export default {
    props:{
        product_id:{
            type:Number
        }
    },
    methods:{
        submit(){
            axios.post('/purchases',{
                product_id:this.product_id
            })
            .then((res) => {
                console.log(res)
                localStorage.setItem('numberOfProductsInPurchase',res.data.data);
            })
            .catch( err => {
                console.log(err)
            });
        }
    }
}
</script>
