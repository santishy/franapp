<template>
    <button
        @click.prevent="destroy"
        class=" bg-red-300 mt-2 rounded transition-all duration-500 ease-in-out hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4 border-b-2 border-red-500 hover:border-transparent mr-1"
    >
        <i class="fas fa-minus-circle"></i>
    </button>
</template>
<script>
export default {
    props:{
        id:{
            type:Number
        }
    },
    methods:{
        destroy(){
            axios.delete(`/sales/${this.id}`)
                .then(res => {
                    console.log(res.data)
                })
                .catch((err) => {
                    console.log(err);
                });
        }
    }
}
</script>