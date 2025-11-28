<template>
    <layout-component>
        <div class="w-full px-4">
            <div class="shadow pb-4 bg-white rounded-sm">
                <h1
                    class="
                        text-blue-800
                        form-header
                        text-center
                        border-b-2 border-gray-300
                        py-3
                        text-xl
                        font-extralight
                    "
                >
                    Reporte de {{ name }}
                </h1>
                <transition name="fade">
                    <div
                        v-if="total != null"
                        class="
                            border-b-2
                            py-3
                            text-gray-800
                            border-gray-300
                            flex
                            justify-center
                            items-center
                        "
                    >
                        <span class="font-semibold text-xl">Total:</span>
                        <div class="font-bold text-2xl ml-2">${{ total }}</div>
                    </div>
                </transition>
                <errors-component :errors-found="errors"></errors-component>

                <report-by class="mt-2"></report-by>
                <div class="px-10">

                    <warehouse-checklist :warehouses="warehouses">
                    </warehouse-checklist>
                </div>
            </div>
        </div>

        <transaction-list :uri="uri" :name="name"> </transaction-list>
    </layout-component>
</template>
<script>
import ReportBy from "./ReportBy.vue";
import ErrorsComponent from "../ErrorsComponent.vue";
import WarehouseChecklist from "../warehouses/WarehouseChecklist.vue";

export default {
    components: { ReportBy,  ErrorsComponent, WarehouseChecklist },
    props: {
        name: {
            type: String,
        },
        uri: {
            type: String,
        },
        users: {
            type: Array,
        },
        warehouses: {
            type: Array,
        },
    },
    provide() {
        return {
            users: this.users,
        };
    },
    data() {
        return {
            total: null,
        };
    },
    mounted() {
        EventBus.$on("calculated-total", (total) => {
            this.total = total;
        });
        EventBus.$on("errors-found", this.errorsFound);
        console.log(this.users, "usuarios en Transactions.vue");
    },
    methods: {
        errorsFound(errors) {
            console.log("entro a los errors");
            this.getErrors(errors);
        },

    },
};
</script>
