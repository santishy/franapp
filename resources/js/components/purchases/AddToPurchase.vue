<template>
    <form @submit.prevent="submit">
        <input type="hidden" name="product_id" />
        <button
            class="bg-purple-500 border-purple-900 border-b-4 hover:bg-purple-700 text-white font-bold py-1 px-4 rounded-full text-2xl"
        >
            C <i class="fas fa-arrow-right"></i> {{getNumberOfProductsInPurchase}}
        </button>
    </form>
</template>
<script>
import {mapGetters} from 'vuex'
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
                localStorage.setItem('numberOfProductsInPurchase',res.data);
            })
            .catch( err => {
                console.log(err)
            });
        }
    },
    computed:{
        ...mapGetters(['getNumberOfProductsInPurchase']),
    }
}
</script>
