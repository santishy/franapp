<template>
    <button
        class="rounded px-4 py-2 bg-red-600 hover:bg-red-400 text-white font-bold"
        @click="cancelPurchase"
    >
        <i class="far fa-times-circle"></i>
    </button>
</template>
<script>
export default {
    data(){
        return {
            inventory_id:null
        }
    },
    props: {
        id: {
            type: Number
        }
    },
    mounted(){
        EventBus.$on('selected-inventory',(id)=>{
            this.inventory_id = id;
        })
    },
    methods: {
        cancelPurchase() {
            axios
                .delete("/purchases/" + this.id,{
                    params:{
                        inventory_id:this.inventory_id,
                        factor:-1
                    }
                })
                .then(res => {
                    if (res.data.delete) {
                        localStorage.removeItem('productsInPurchase');
                        window.location.replace("/products");
                    }
                })
                .catch(err => {
                    this.getErrors(err);
                });
        }
    }
};
</script>
