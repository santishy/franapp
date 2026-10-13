<template>
    <div class="flex flex-wrap flex-col items-center justify-center">
        <div class="w-full flex flex-col items-center gap-4">
            <!-- Card -->
            <div class="rounded-xl px-4 py-4 w-full max-w-4xl">
                <h2 class="text-lg font-semibold text-slate-700 mb-4">
                    Filtrar reporte por:
                </h2>
                <div class="flex flex-wrap items-center justify-center gap-4">
                    <div class="w-full flex justify-between">
                        <user-filter
                            @user-change="onUserChange"
                            :users="users"
                        />
                        <toggle-component></toggle-component>
                    </div>
                    <!-- Datepicker -->
                    <date-filter @date-change="onDateChange" />
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import ToggleComponent from "./ToggleComponent.vue";
import "vue-datepicker-next/index.css";
import DateFilter from "./DateFilter.vue";
import UserFilter from "./UserFilter.vue";
export default {
    inject: ["users"],
    components: {
        ToggleComponent,
        UserFilter,
        DateFilter,
    },

    data() {
        return {
            status: { "filter[status]": "completed" },

            dates: null,
            userId: {},
        };
    },
    created() {
        EventBus.$on("status-filter-cancelled", this.setStatusFilter);
    },
    beforeUnmount() {
        EventBus.$off("status-filter-cancelled", this.setStatusFilter);
    },
    methods: {
        setStatusFilter(status) {
            this.status["filter[status]"] = status;
        },
        onUserChange(value) {
            this.userId = { ...value };
        },
        onDateChange(value) {
            if (this.userId["filter[user]"]) {
                EventBus.$emit("set-parameters", {
                    ...value,
                    ...this.status,
                    ...this.userId,
                });
                return;
            }
            EventBus.$emit("set-parameters", { ...value, ...this.status });
        },
    },
};
</script>
<style scoped>
@media (max-width: 600px) {
    .mx-datepicker-range {
        width: 100%;
    }
}

.picker-full {
    width: 300px;
    /* o 400px, 500px, lo que necesites */
}

.picker-full :deep(.mx-datepicker) {
    width: inherit;
}
</style>
