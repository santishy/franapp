<template>
    <div>
        <button @click.prevent="getReport">Hoy</button>
    </div>
</template>
<script>
export default {
    props:{
        uri:{
            type:String
        },
        today:{
            type:String
        }
    },
    methods:{
        getReport(){
            axios.get(this.uri,{
                params:{
                    'filter[today]':this.today
                }
            })
            .then ( res => {
                console.log(res.data);
            });
        }
    }
}
</script>