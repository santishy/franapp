<template>
    <div class="w-full flex justify-center mt-20 ">
        <div class="bg-white shadow rounded max-w-full">
            <table class="table-auto overflow-x-auto max-w-full">
                <thead>
                    <tr class="bg-danger">
                        <th class="px-4 py-2">Nombre</th>
                        <th class="px-4 py-2">Dirección</th>
                        <th class="px-4 py-2">Número tel.</th>
                        <th class="px-4 py-2">Email</th>
                        <th class="px-4 py-2">Empresa</th>
                        <th class="px-4 py-2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <client-list-item
                        v-for="client in clients.data"
                        :key="client.id"
                        :client="client"
                    />
                </tbody>
            </table>
        </div>
    </div>
</template>
<script>
import ClientListItem from "./ClientListItem.vue";
export default {
    components: { ClientListItem },
    props: {
        clients: {
            type: Object
        }
    }
};
</script>
