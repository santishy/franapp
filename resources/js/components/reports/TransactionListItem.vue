<template>
    <tr>
        <td class="border px-4 py-2">{{ transaction.id }}</td>
        <td class="border px-4 py-2">{{ transaction.created_at }}</td>
        <td class="border px-4 py-2">{{ transaction.total }}</td>
        <td class="border px-4 py-2">
            <modal-component
                :products="transaction.products"
                :transaction-type="transaction.transactionType"
            >
            </modal-component>
        </td>
        <td>
            <cancel-transaction
                :uri="`/purchases/${transaction.id}`"
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
            type: Object
        }
    },
    components: {
        "modal-component": Modal,
        CancelTransaction
    }
};
</script>
