<template>
    <div class="container mx-auto mt-4 flex justify-center">
        <table v-if="this.params" class="table-auto bg-white">
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
                    :transaction-type="transaction.transactionType"
                    :key="transaction.id"
                >
                </transaction-list-item>
            </tbody>
            <infinite-loading
                @infinite="infiniteHandler"
                :identifier="infiniteId"
            ></infinite-loading>
        </table>
    </div>
</template>
<script>
import InfiniteLoading from "vue-infinite-loading";
import TransactionListItem from "./TransactionListItem.vue";
export default {
    components: {
        TransactionListItem,
        InfiniteLoading
    },
    props: {
        transactionType: {
            type: String
        },
        uri: {
            type: String
        }
    },
    data() {
        return {
            transactions: [],
            page: 1,
            params: null,
            infiniteId: 1
        };
    },
    mounted() {
        EventBus.$on("transactions-found", res => {
            this.transactions = res;
        });
        EventBus.$on("set-parameters", data => {
            this.changeParams(data);
        });
    },
    methods: {
        infiniteHandler($state) {
            axios
                .get(this.uri, {
                    params: {
                        page: this.page,
                        ...this.params
                    }
                })
                .then(res => {
                    if (res.data.data.length) {
                        if (this.page == 1) {
                            if(typeof res.data.total == 'undefined')
                                res.data.total = 0;
                            EventBus.$emit("calculated-total", res.data.total);
                        }
                        this.page += 1;
                        this.transactions.push(...res.data.data);
                        $state.loaded();
                    } else {
                        if(this.page == 1)
                            EventBus.$emit("calculated-total", res.data.total);
                        $state.complete();
                    }
                });
        },
        changeParams(value) {
            this.params = value;
            this.page = 1;
            this.transactions = [];
            this.infiniteId += 1;
        }
    }
};
</script>
