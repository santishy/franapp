<template>

    <div v-if="show" class="w-full bg-blue-100 border-t border-b border-red-500 text-red-700 px-4 py-3" role="alert">
        <p class="font-bold">Se detecto los siguientes errores:</p>
        <p v-for="error in errorsFound" class="text-sm" :key="error">{{error}}</p>
    </div>
    
</template>

<script>
export default {
    data(){
        return {
            show:false
        }
    },
    props:{
        errorsFound:{
            type:Array
        }
    },
     watch: {
        errors: {
            deep: true,
            handler() {
                this.show = true;
                setTimeout(() => {
                    this.show = false;
                }, 1500);
            },
        },
    }
}
</script>