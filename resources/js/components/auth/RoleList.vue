<template>
    <div class="bg-white w-full rounded shadow p-4 ">
        <ul class="list-inside bg-gray-200">
            <li v-for="role in roles" :key="role.id">
                <a href="#" @click.prevent="" class="w-full p-2 block border-white border-b-2 ">{{role.name}}</a>
            </li>
        </ul>
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