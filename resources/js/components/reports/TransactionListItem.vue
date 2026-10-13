<template>
    <tr
        class="bg-white border-b border-gray-400 md:border-none block md:table-row"
    >
        <td
            class="p-2 md:border md:border-grey-500 text-left block md:table-cell"
        >
            <span class="inline-block w-1/3 md:hidden font-bold">Nota</span>
            {{ transaction.id }}
        </td>
        <td
            class="p-2 md:border md:border-grey-500 text-left block md:table-cell"
        >
            <span class="inline-block w-1/3 md:hidden font-bold">Usuario</span
            >{{ transaction.username }}
        </td>
        <td
            v-if="areTheySales"
            class="p-2 md:border md:border-grey-500 text-left block md:table-cell"
        >
            <span class="inline-block w-1/3 md:hidden font-bold">Cliente</span
            >{{ getCustomerName }}
        </td>
        <td
            class="p-2 md:border md:border-grey-500 text-left block md:table-cell"
        >
            <span class="inline-block w-1/3 md:hidden font-bold">Fecha</span
            >{{ transaction.created_at }}
        </td>
        <td
            class="p-2 md:border md:border-grey-500 text-left block md:table-cell"
        >
            <span class="inline-block w-1/3 md:hidden font-bold">Total</span
            >{{ transaction.total }}
        </td>
        <td
            class="p-2 md:border md:border-grey-500 text-left block md:table-cell"
        >
            <span class="inline-block w-1/3 sms:hidden font-bold">Ver</span>
            <modal-component class="inline-block" :transaction="transaction" />
        </td>
        <td
            class="p-2 md:border md:border-grey-500 text-left block md:table-cell"
        >
            <span class="inline-block w-1/3 md:hidden font-bold">Acciones</span>
            <div class="flex items-center justify-center space-x-2">
                <a
                    :href="`/sales/${transaction?.id}/returns`"
                    class="rounded bg-yellow-300 p-1 text-slate-600 hover:bg-yellow-500 hover:text-white shadow hover:shadow-none text-xs flex space-x-2 items-center"
                >
                    <ArrowUturnLeftIcon class="w-3 h-3" />
                    <span>Devoluciones</span>
                </a>
                <cancel-transaction
                    :uri="uri"
                    :transaction="transaction"
                ></cancel-transaction>
            </div>
        </td>
    </tr>
</template>
<script>
import Modal from "../Modal.vue";
import CancelTransaction from "./CancelTransaction.vue";
import ArrowUturnLeftIcon from "../icons/ArrowUturnLeftIcon.vue";
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
        ArrowUturnLeftIcon,
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
