<template>
    <div class="flex flex-wrap flex-col items-center justify-center">
        <div class="w-full flex flex-col items-center gap-4">

    <!-- Card -->
    <div class="  rounded-xl px-4 py-4 w-full max-w-4xl">

        <h2 class="text-lg font-semibold text-slate-700 mb-4 ">
            Filtrar reporte por:
        </h2>
        <div class="flex flex-wrap items-center justify-center gap-4">

            <div class="w-full flex justify-between">
               <select v-model="userId['filter[user]']" id="countries" class="block w-96  px-3 py-2.5 bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded focus:ring-brand focus:border-brand shadow-xs placeholder:text-body">
                    <option :value="''" selected>Todos los usuarios</option>
                    <option v-for="user in users" :key="user.id" :value="`${user.id}`">
                        {{ user.name }}
                    </option>
                </select>
                <toggle-component></toggle-component>
            </div>
            <!-- Datepicker -->
            <date-picker
                class="flex-1"
                @change="getReport(range, 'betweenDates')"
                placeholder="Da click para elegir el rango de fechas"
                :lang="lang"
                value-type="YYYY-MM-DD"
                v-model="dates"
                range
            ></date-picker>

            <!-- Botones -->
            <div class="flex gap-2">
                <button
                    class="text-white bg-slate-700 hover:bg-slate-900 px-4 py-2 rounded"
                    @click.prevent="getReport(today)"
                >
                    Hoy
                </button>

                <button
                    class="text-white bg-slate-700 hover:bg-slate-900 px-4 py-2 rounded"
                    @click.prevent="getReport(week)"
                >
                    Semana
                </button>

                <button
                    class="text-white bg-slate-700 hover:bg-slate-900 px-4 py-2 rounded"
                    @click.prevent="getReport(month)"
                >
                    Mes
                </button>
            </div>
        </div>

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
    inject: ["users"],
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
            userId: {
                "filter[user]": "",
            },
        };
    },
    methods: {
        getReport(value, reportBy = "") {
            if (reportBy === "betweenDates") {
                if (this.dates?.length) {
                    this.range["filter[betweenDates]"] = this.dates.toString(); //convierto el array de las dos fechas de rango a un string separado por comas
                }
            }
            if(this.userId['filter[user]']){
                EventBus.$emit("set-parameters", _.merge(value, this.status, this.userId)); //._merge combina dos json
                return;
            }
            EventBus.$emit("set-parameters", _.merge(value, this.status)); //._merge combina dos json
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
.picker-full {
    width: 300px; /* o 400px, 500px, lo que necesites */
}

.picker-full >>> .mx-datepicker {
    width: inherit;
}

</style>
