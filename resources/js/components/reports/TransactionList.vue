<template>
    <div class="container mx-auto mt-4 flex justify-center">
        <table v-if="params" class="table-auto bg-white">
            <thead>
                <tr class="bg-purple-200">
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Fecha</th>
                    <th class="px-4 py-2">Total</th>
                    <th class="px-4 py-2">Ver</th>
                    <th class="px-4 py-2">Acciones</th>
                </tr>
            </thead>

            <transition-group name="bounce" tag="tbody">
                <transaction-list-item
                    v-for="transaction in transactions"
                    :transaction="transaction"
                    :transaction-type="transaction.transactionType"
                    :key="transaction.id"
                    :uri="uri"
                >
                </transaction-list-item>
            </transition-group>

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
        /*EventBus.$on("transactions-found", res => {
            this.transactions = res;
        });*/

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
                    if (this.page == 1)
                        EventBus.$emit("calculated-total", res.data.total);
                    if (res.data.data.length) {
                        this.page += 1;
                        this.transactions.push(...res.data.data);
                        $state.loaded();
                    } else {
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
