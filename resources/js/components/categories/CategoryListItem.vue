<template>
    <li class="flex justify-between">
        {{ categorys.name }} 
        <button>
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
            type:Object,
            required:true
        }
    }
}
</script>
