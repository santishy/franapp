<template>
    <div>
        {{roles}}
    </div>
</template>
<script>
export default {
    data:()=>({
        roles:[]
    }),
    created(){
        axios('/roles')
            .then( res => {
                if(res.data.data.length){
                    this.roles = res.data.data;
                }
            })
    }
}
</script>