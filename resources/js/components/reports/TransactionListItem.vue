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
            <span class="inline-block w-1/3 md:hidden font-bold">Nota</span>
            {{ transaction.id }}
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
            <span class="inline-block w-1/3 md:hidden font-bold">Usuario</span
            >{{ transaction.username }}
        </td>
        <td
            v-if="areTheySales"
            class="
                p-2
                md:border md:border-grey-500
                text-left
                block
                md:table-cell
            "
        >
            <span class="inline-block w-1/3 md:hidden font-bold">Cliente</span
            >{{ getCustomerName }}
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
            <span class="inline-block w-1/3 md:hidden font-bold">Fecha</span
            >{{ transaction.created_at }}
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
            <span class="inline-block w-1/3 md:hidden font-bold">Total</span
            >{{ transaction.total }}
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
            <span class="inline-block w-1/3 md:hidden font-bold">Ver</span>
            <modal-component :transaction="transaction"> </modal-component>
        </td>
        <td>
            <span class="inline-block w-1/3 md:hidden font-bold">Acciones</span>
            <cancel-transaction
                :uri="uri"
                :transaction="transaction"
            ></cancel-transaction>
        </td>
    </tr>
</template>
<script>
import Modal from "../Modal.vue";
import CancelTransaction from "./CancelTransaction.vue";
export default {
    props: {
        transaction: {
            type: Object,
        },
        uri: {
            type: String,
        },
        index: {
            type: Number,
        },
        areTheySales: {
            type: Boolean,
        },
    },
    components: {
        "modal-component": Modal,
        CancelTransaction,
    },
    computed: {
        getCustomerName() {
            return this.transaction.client
                ? this.transaction.client.name
                : "Publico en general";
        },
    },
};
</script>
