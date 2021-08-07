<template>
    <button @click="action">
        Aceptar
    </button>
</template>
<script>

export default{
    props:{
        method:{
            type:String
        },
    },
    methods:{
        action(){
            this.$emit(this.method)
        }
    }
}
</script>
