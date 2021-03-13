<template>
    <tr>
        <td class="border px-4 py-2">{{transaction.id}}</td>
        <td class="border px-4 py-2">{{transaction.created_at}}</td>
        <td class="border px-4 py-2">{{transaction.total}}</td>
    </tr>
</template>
<script>
export default {
    props: {
        transaction: {
            type: Object
        }
    }
};
</script>
