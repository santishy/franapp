<template>
    <div class="w-full shadow  pb-4 bg-white">
        <h1
            class="font-extrabold text-center border-b-2 border-gray-300 py-3 text-2xl"
        >
            Corte
        </h1>
        <report-by class="mt-4" :uri="uri" :today="today"></report-by>
        <transaction-list></transaction-list>
    </div>
</template>
<script>
import ReportBy from "./ReportBy.vue";
export default {
    props: {
        today: {
            type: String
        },
        uri: {
            type: String,
            required: true
        }
    },
    components: { ReportBy }
};
</script>
