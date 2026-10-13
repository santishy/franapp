<template>
    <div class="flex flex-wrap space-x-4 items-center w-full">
        <date-picker
            class="flex-1"
            @change="getReport('betweenDates')"
            placeholder="Da click para elegir el rango de fechas"
            :lang="lang"
            format="YYYY-MM-DD"
            value-type="date"
            v-model:value="dates"
            range
        ></date-picker>

        <!-- Botones -->
        <div class="flex gap-2">
            <button
                class="text-white bg-slate-700 hover:bg-slate-900 px-4 py-2 rounded"
                @click.prevent="getReport('today')"
            >
                Hoy
            </button>

            <button
                class="text-white bg-slate-700 hover:bg-slate-900 px-4 py-2 rounded"
                @click.prevent="getReport('week')"
            >
                Semana
            </button>

            <button
                class="text-white bg-slate-700 hover:bg-slate-900 px-4 py-2 rounded"
                @click.prevent="getReport('currentMonth')"
            >
                Mes
            </button>
        </div>
    </div>
</template>

<script>
import DatePicker from "vue-datepicker-next";
import ConfigDatePicker from "../../mixins/ConfigDatePicker.js";

export default {
    components: {
        DatePicker,
    },
    mixins: [ConfigDatePicker],
    emits: ["date-change"],
    data() {
        return {
            dates: null,
        };
    },
    methods: {
        formatDate(date) {
            return date.toISOString().slice(0, 10);
        },
        getReport(name) {
            const filter = { [`filter[${name}]`]: "" };
            if (name === "betweenDates") {
                if (!this.dates?.length) {
                    return;
                }
                //convierto el array de las dos fechas de rango a un string separado por comas
                filter[`filter[${name}]`] = this.dates
                    .map(this.formatDate)
                    .toString();
                this.dates = null;
            }

            this.$emit("date-change", filter);
        },
    },
};
</script>
