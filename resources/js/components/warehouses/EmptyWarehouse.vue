<template>
    <form @submit.prevent="submit">
        <button type="submit">Vaciar almacén</button>
    </form>
</template>

<script>
export default {
    props:{
        warehouse:{
            type:Object
        }
    },
    methods:{
        submit(){
            axios.delete('/warehouses/'+this.warehouse.id,{id:this.warehouse.id})
                .then(res => {
                    console.log(res)
                })
        }
    }
}
</script>