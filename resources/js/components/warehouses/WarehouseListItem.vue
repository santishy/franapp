<template>
    <tr>
        <td class="border px-4 py-2">{{inventory.name}}</td>
        <td class="border px-4 py-2">{{inventory.address}}</td>
        <td class="border px-4 py-2">
            
        </td>
    </tr>
</template>
<script>
export default {
    props:{
        inventory:{
            type:Object
        }
    }
}
</script>