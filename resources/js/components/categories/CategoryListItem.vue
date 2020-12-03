<template>
    <li class="flex justify-between">
        {{ category }} 
        <button @click.prevent="">
            <span>
                <i class="far fa-circle"></i>
            </span>
        </button>
    </li>
</template>
<script>
export default {
    props:{
        category:{
            type:Object
        }
    }
}
</script>
