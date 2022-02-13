<template>
    <nav-component>
        <div class="w-full flex justify-center px-4">
            <div
                class="
                    flex
                    justify-center
                    bg-white
                    shadow-sm
                    w-full
                    rounded
                    max-w-full
                    sm:overflow-x-hidden
                    overflow-x-auto
                "
            >
                <table
                    v-if="clients.length"
                    v-can="'view clients'"
                    class="
                        min-w-full
                        border-collapse
                        block
                        md:table
                        shadow-sm
                        text-center
                        rounded-lg
                    "
                >
                    <thead class="block md:table-header-group">
                        <tr
                            class="
                                border-b border-gray-500
                                rounded-t-sm
                                md:border-none
                                block
                                md:table-row
                                absolute
                                -top-full
                                md:top-auto
                                -left-full
                                md:left-auto md:relative
                            "
                        >
                            <th
                                class="
                                    bg-blue-700
                                    p-2
                                    text-white
                                    font-semibold
                                    md:border md:border-grey-500
                                    text-left
                                    block
                                    md:table-cell
                                "
                            >
                                Nombre
                            </th>
                            <th
                                class="
                                    bg-blue-700
                                    p-2
                                    text-white
                                    font-semibold
                                    md:border md:border-grey-500
                                    text-left
                                    block
                                    md:table-cell
                                "
                            >
                                Dirección
                            </th>
                            <th
                                class="
                                    bg-blue-700
                                    p-2
                                    text-white
                                    font-semibold
                                    md:border md:border-grey-500
                                    text-left
                                    block
                                    md:table-cell
                                "
                            >
                                Número tel.
                            </th>
                            <th
                                class="
                                    bg-blue-700
                                    p-2
                                    text-white
                                    font-semibold
                                    md:border md:border-grey-500
                                    text-left
                                    block
                                    md:table-cell
                                "
                            >
                                Email
                            </th>
                            <th
                                class="
                                    bg-blue-700
                                    p-2
                                    text-white
                                    font-semibold
                                    md:border md:border-grey-500
                                    text-left
                                    block
                                    md:table-cell
                                "
                            >
                                Empresa
                            </th>
                            <th
                                class="
                                    bg-blue-700
                                    p-2
                                    text-white
                                    font-semibold
                                    md:border md:border-grey-500
                                    text-left
                                    block
                                    md:table-cell
                                "
                            >
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody class="block md:table-row-group alternate-table-row">
                        <client-list-item
                            v-for="(client, index) in clients"
                            :key="client.id"
                            :client="client"
                            :index="index"
                        />
                    </tbody>
                </table>
            </div>
        </div>
    </nav-component>
</template>
<script>
import NavComponent from "../NavComponent.vue";
import ClientListItem from "./ClientListItem.vue";
export default {
    components: { ClientListItem, NavComponent },

    data() {
        return {
            clients: [],
        };
    },

    mounted() {
        EventBus.$on("client-removed", (index) => {
            this.clients.splice(index, 1);
        });
        this.getClients();
    },
    methods: {
        getClients() {
            axios
                .get("/clients")
                .then((res) => {
                    this.clients.push(...res.data.data);
                    console.log(res.data.data);
                })
                .catch((err) => {
                    console.log(err);
                });
        },
    },
};
</script>
