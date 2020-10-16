<template>
    <div class="w-full bg-blue-100 border-t border-b border-red-500 text-red-700 px-4 py-3" role="alert">
        <p class="font-bold">Se detecto los siguientes errores:</p>
        <p v-for="error in errors" class="text-sm" :key="error">{{error}}</p>
    </div>
</template>

<script>
export default {
    props:{
        errors:{
            type:Array
        }
    }
}
</script>