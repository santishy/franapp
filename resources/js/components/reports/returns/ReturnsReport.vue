<template>
    <layout-component>
        <div class="px-4 py-4">
            <div class="rounded-2xl shadow bg-white p-4">
                <h1 class="text-lg text-slate-800 font-semibold">
                    Reporte de devoluciones
                </h1>
                <div class="md:max-w-4xl w-full mx-auto mt-4">
                    <UserFilter @user-change="onUserChange" :users="users" />
                    <DateFilter class="mt-4" @date-change="onDateChange" />
                    <warehouse-checklist :warehouses="warehouses">
                    </warehouse-checklist>
                </div>
            </div>

            <ReturnList
                v-if="Object.keys(params).length"
                :params="params"
                :uri="uri"
                class="mt-4"
            />
        </div>
    </layout-component>
</template>

<script setup>
import { ref, onMounted, onUnmounted, computed } from "vue";
import LayoutComponent from "../../LayoutComponent.vue";
import DateFilter from "../DateFilter.vue";
import UserFilter from "../UserFilter.vue";
import ReturnList from "./ReturnList.vue";
import WarehouseChecklist from "../../warehouses/WarehouseChecklist.vue";

const userFilter = ref({});
const dateFilter = ref({});
const warehouseFilter = ref({});
defineProps({
    uri: { type: String },
    users: {
        type: Array,
    },
    warehouses: {
        type: Array,
    },
});

const onUserChange = (value) => {
    userFilter.value = value;
};
const onDateChange = (value) => {
    dateFilter.value = value;
};
onMounted(() => {
    EventBus.$on("selected-warehouses", buildAWarehouseFilter);
});
onUnmounted(() => {
    EventBus.$off("selected-warehouses", buildAWarehouseFilter);
});
const buildAWarehouseFilter = (ids) => {
    warehouseFilter.value["filter[byWarehouses]"] = ids.toString();
};
const params = computed(() => {
    return {
        ...userFilter.value,
        ...dateFilter.value,
        ...warehouseFilter.value,
    };
});
</script>
