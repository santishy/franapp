<template>
    <div class="flex flex-wrap flex-col items-center justify-center">
        <div class="flex justify-center flex-wrap items-center max-w-xs">
            <div class="p-1 border bg-gray-700 rounded text-white px-2">
                <span>Reporte por rango</span>
                <date-picker
                    @change="getReport(range, 'betweenDates')"
                    placeholder="Da click para eligir el rango de fechas"
                    class="shodow-inner"
                    :lang="lang"
                    value-type="YYYY-MM-DD"
                    v-model="dates"
                    range
                ></date-picker>
            </div>
            <div>
                <button
                    class="
                        text-white
                        bg-gray-700
                        hover:bg-gray-900
                        focus:outline-none
                        focus:ring-2
                        focus:ring-purple-600
                        focus:ring-opacity-50
                        mr-2
                        rounded
                        px-4
                        py-2
                    "
                    @click.prevent="getReport(today)"
                >
                    Hoy
                </button>
                <button
                    class="
                        text-white
                        bg-gray-700
                        hover:bg-gray-900
                        focus:outline-none
                        focus:ring-2
                        focus:ring-purple-600
                        focus:ring-opacity-50
                        mr-2
                        rounded
                        px-4
                        py-2
                    "
                    href="#"
                    @click.prevent="getReport(week)"
                >
                    Semana
                </button>
                <button
                    class="
                        text-white
                        bg-gray-700
                        hover:bg-gray-900
                        focus:outline-none
                        focus:ring-2
                        focus:ring-purple-600
                        focus:ring-opacity-50
                        rounded
                        px-4
                        py-2
                        mr-2
                    "
                    href="#"
                    @click.prevent="getReport(month)"
                >
                    Mes
                </button>
            </div>
            <toggle-component class="col-span-1 mr-2"></toggle-component>
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
        DatePicker,
    },
    mixins: [ConfigDatePicker],
    created() {
        EventBus.$on("status-filter-cancelled", (status) => {
            this.status["filter[status]"] = status;
        });
    },
    data() {
        return {
            range: {
                "filter[betweenDates]": [],
            },
            today: {
                "filter[today]": "",
            },
            week: {
                "filter[week]": "",
            },
            month: {
                "filter[currentMonth]": "",
            },
            status: { "filter[status]": "completed" },
            dates: null,
        };
    },
    methods: {
        getReport(value, reportBy = "") {
            if (reportBy === "betweenDates") {
                if (this.dates?.length) {
                    this.range["filter[betweenDates]"] = this.dates.toString(); //convierto el array de las dos fechas de rango a un string separado por comas
                }
            }
            EventBus.$emit("set-parameters", _.merge(value, this.status)); //._merge conbina dos json
        },
    },
};
</script>
<style scoped>
@media (max-width: 600px)  {
    .mx-datepicker-range {
        width: 100%;
    }
}
</style>
