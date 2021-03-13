<template>
    <div class="container mx-auto mt-4 flex justify-center">
        <table v-if="transactions.length" class="table-auto bg-white">
            <thead>
                <tr class="bg-purple-200">
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Fecha</th>
                    <th class="px-4 py-2">Total</th>
                    <th class="px-4 py-2">Ver</th>
                </tr>
            </thead>
            <tbody>
                <transaction-list-item
                    v-for="transaction in transactions"
                    :transaction="transaction"
                    :key="transaction.id"
                >
                </transaction-list-item>
            </tbody>
        </table>
    </div>
</template>
<script>
import TransactionListItem from "./TransactionListItem.vue";
export default {
    components: {
        TransactionListItem
    },
    props: {
        transactionType: {
            type: String
        }
    },
    data() {
        return {
            transactions: []
        };
    },
    mounted() {
        EventBus.$on("transactions-found", res => {
            this.transactions = res;
        });
    }
};
</script>
