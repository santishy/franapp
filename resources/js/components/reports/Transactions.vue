<template>
    <div class="md:w-4/5 mx-auto shadow rounded px-2 py-4 mt-10">
        <report-by :uri="uri" :today="today"></report-by>
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
