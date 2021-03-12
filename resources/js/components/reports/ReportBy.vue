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
    },
    methods:{
        getReport(){
            const today = new Date();
            axios.get(this.uri,{
                params:{
                    "filter[today]":'',
                    "filter[status]":'completed'
                }
            })
            .then ( res => {
                console.log(res.data);
            });
        }
    }
}
</script>