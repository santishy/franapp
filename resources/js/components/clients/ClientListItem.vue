<template>
    <tr
        class="
            bg-white
            border-b border-gray-400
            md:border-none
            block
            md:table-row
        "
    >
        <td
            class="
                p-2
                md:border md:border-grey-500
                text-left
                block
                md:table-cell
            "
        >
            <span class="inline-block w-1/3 md:hidden font-bold">Nombre</span
            >{{ client.name }}
        </td>
        <td
            class="
                p-2
                md:border md:border-grey-500
                text-left
                block
                md:table-cell
            "
        >
            <span class="inline-block w-1/3 md:hidden font-bold">Dirección</span
            >{{ client.address }}
        </td>
        <td
            class="
                p-2
                md:border md:border-grey-500
                text-left
                block
                md:table-cell
            "
        >
            <span class="inline-block w-1/3 md:hidden font-bold">Télefono</span
            >{{ client.phone_number }}
        </td>
        <td
            class="
                p-2
                md:border md:border-grey-500
                text-left
                block
                md:table-cell
            "
        >
            <span class="inline-block w-1/3 md:hidden font-bold">Correo</span
            >{{ client.email }}
        </td>
        
        <td
            class="
                p-2
                md:border md:border-grey-500
                text-left
                block
                md:table-cell
            "
        >
            <span class="inline-block w-1/3 md:hidden font-bold">Acciones</span>
            <a
                :href="` clients/${client.phone_number}/edit`"
                v-can="'edit client'"
                class="
                    bg-blue-500
                    inline-block
                    cursor-pointer
                    hover:bg-blue-400
                    text-white
                    font-bold
                    py-2
                    px-4
                    hover:border-blue-500
                    rounded
                "
            >
                <edit-icon></edit-icon>
            </a>
            <button
                @click="deleteClient"
                v-can="'delete client'"
                class="
                    bg-red-500
                    hover:bg-red-400
                    text-white
                    font-bold
                    py-2
                    px-4
                    hover:border-red-500
                    rounded
                "
            >
                <trash-icon></trash-icon>
            </button>
        </td>
    </tr>
</template>
<script>
import TrashIcon from "../icons/TrashIcon.vue";
import EditIcon from "../icons/EditIcon.vue";
export default {
    components: { TrashIcon, EditIcon },
    props: {
        client: {
            type: Object,
            required: true,
        },
        index: {
            type: Number,
            required: true,
        },
    },
    methods: {
        deleteClient() {
            axios
                .delete(`/clients/${this.client.phone_number}`)
                .then((res) => {
                    if (res.data) {
                        EventBus.$emit("client-removed", this.index);
                    }
                })
                .catch((err) => {
                    console.log(err);
                });
        },
    },
};
</script>
