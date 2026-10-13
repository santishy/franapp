<template>
<div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table
            class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
        >
            <thead
                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
            >
                <tr>
                    <th scope="col" class="px-6 py-3">ID</th>
                    <th scope="col" class="px-6 py-3">Fecha</th>
                    <th scope="col" class="px-6 py-3">Nota</th>
                    <th scope="col" class="px-6 py-3">Usuario</th>
                    <th scope="col" class="px-6 py-3">Resolución</th>
                    <th scope="col" class="px-6 py-3">Total</th>
                    <th scope="col" class="px-6 py-3">Productos</th>
                </tr>
            </thead>
            <tbody

            >
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600" v-for="r in saleReturns" :key="r.id">
                    <td class="px-6 py-4">{{ r.id }}</td>
                    <td class="px-6 py-4">{{ r.created_at}}</td>
                    <td class="px-6 py-4">{{ r.original_sale_id }}</td ">
                    <td class="px-6 py-4">{{ r.username }}</td>
                    <td class="px-6 py-4">{{ r.resolution }}</td>
                    <td class="px-6 py-4">{{ r.total }}</td>
                    <td class="px-6 py-4">
                        <modal :transaction="r" />
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
        <infinite-loading
            :identifier="infiniteId"
            @infinite="getSaleReturns"
        ></infinite-loading>
</div>
</template>

<script setup>
import { ref, watch } from "vue";
import Modal from "../../Modal.vue";

const props = defineProps({
    params: {
        type: Object,
    },
    uri: {
        type: String,
        required: true,
    },
});
const page = ref(1);
const infiniteId = ref(1);

const getSaleReturns = async ($state) => {
    try {
        const { data } = await axios.get(props.uri, {
            params: { ...props.params, page: page.value },
        });
        if (data.data.length) {
            page.value += 1;
            saleReturns.value.push(...data.data);
            $state.loaded();
            return;
        }
        $state.complete();
    } catch (error) {
        $state.error();
        console.log(error);
    }
};
const saleReturns = ref([]);

watch(
    () => props.params,
    () => {
        saleReturns.value = []
        page.value = 1;
        infiniteId.value += 1;
    },
);
</script>
