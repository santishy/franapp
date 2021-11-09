<template>
    <div class="flex flex-wrap flex-col items-center justify-center">
        <toggle-component class="col-span-1 mr-2 mb-4"></toggle-component>
        <div class="flex justify-center flex-wrap">
            <div>
                <button
                    class="text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:ring-opacity-50 mr-4 rounded px-4 py-2"
                    @click.prevent="getReport(today)"
                >
                    Hoy
                </button>
                <button
                    class="text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:ring-opacity-50 mr-4 rounded px-4 py-2"
                    href="#"
                    @click.prevent="getReport(week)"
                >
                    Semana
                </button>
                <button
                    class="text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:ring-opacity-50 rounded px-4 py-2"
                    href="#"
                    @click.prevent="getReport(month)"
                >
                    Mes
                </button>
                <date-picker :lang="lang" v-model="range" range></date-picker>
            </div>
        </div>
    </div>
</template>
<script>
import ToggleComponent from "./ToggleComponent.vue";
import DatePicker from "vue2-datepicker";
import "vue2-datepicker/index.css";
import ConfigDatePicker from "../../mixins/ConfigDatePicker.js";
export default {
    components: {
        ToggleComponent,
        DatePicker
    },
    mixins:[ConfigDatePicker],
    created() {
        EventBus.$on("status-filter-cancelled", status => {
            this.status["filter[status]"] = status;
        });
    },
    data() {
        return {
            today: {
                "filter[today]": ""
            },
            week: {
                "filter[week]": ""
            },
            month: {
                "filter[currentMonth]": ""
            },
            status: { "filter[status]": "completed" },
            range:null,
        };
    },
    methods: {
        getReport(value) {
            EventBus.$emit("set-parameters", _.merge(value, this.status)); //._merge conbina dos json
        }
    }
};
</script>
