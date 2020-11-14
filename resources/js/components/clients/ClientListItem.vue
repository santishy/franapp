<template>
    <tr>
        <td class="border px-4 py-2">{{ client.name }}</td>
        <td class="border px-4 py-2">{{ client.address }}</td>
        <td class="border px-4 py-2">{{ client.phone_number }}</td>
        <td class="border px-4 py-2">{{ client.email }}</td>
        <td class="border px-4 py-2">{{ client.company }}</td>
        <td class="border px-4 py-2">
            <a
                :href="`/clients/${client.id}/edit`"
                class="bg-blue-500 inline-block cursor-pointer hover:bg-blue-400 text-white font-bold py-2 px-4 hover:border-blue-500 rounded"
            >
                <i class="far fa-edit"></i>
            </a>
        </td>
    </tr>
</template>
<script>
export default {
    props: {
        client: {
            type: Object,
            required: true
        }
    }
};
</script>
