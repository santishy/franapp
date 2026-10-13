<template>
    <div
        class="relative overflow-x-auto rounded-2xl shadow-lg bg-white px-2 py-4"
    >
        <form @submit.prevent="handleSubmit">
            <div class="py-4 flex justify-end">
                <select
                    v-model="payment_method"
                    name="payment_method"
                    :class="
                        payment_method === ''
                            ? 'text-slate-400'
                            : 'text-slate-900'
                    "
                    class="w-full md:w-6/12 border-transparent focus:outline-none rounded-sm px-3 py-1 bg-slate-50 ring-1 ring-purple-500 ring-offset-1"
                >
                    <option value="" disabled>
                        Elige un método de devolución
                    </option>
                    <option value="cash">Efectivo</option>
                    <option value="card">Tarjeta</option>
                    <option value="bank_transfer">Transferencia</option>
                </select>
            </div>
            <table
                v-if="sale?.products?.length"
                class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
            >
                <thead
                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                >
                    <tr>
                        <th scope="col" class="px-6 py-3">SKU</th>
                        <th scope="col" class="px-6 py-3">PRECIO</th>

                        <th scope="col" class="px-6 py-3">CANT. RETORNABLE</th>
                        <th scope="col" class="px-6 py-3">
                            CANTIDAD A RETORNAR
                        </th>
                    </tr>
                </thead>
                <tbody
                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200"
                >
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200"
                        v-for="product in sale.products"
                        :key="product.id"
                    >
                        <td class="px-6 py-4">
                            {{ product.sku }}
                        </td>
                        <td class="px-6 py-4">
                            {{ product.pivot.sale_price }}
                        </td>
                        <td class="px-6 py-4">
                            {{ product.returnableQty }}
                        </td>
                        <td class="px-6 py-4">
                            <ReturnQuantity
                                :product="product"
                                @update:returnQty="updateReturnProducts"
                            />
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="mt-4">
                <errors-component :errors-found="errors" />
            </div>
            <div class="flex items-center justify-end w-full mt-4">
                <button type="submit" class="btn-primary" :disabled="disabled">
                    Hacer devolución
                </button>
            </div>
        </form>
    </div>
</template>

<script setup>
import { ref } from "vue";
import { useErrors } from "../../composables/useErrors";
import ReturnQuantity from "./ReturnQuantity.vue";
import { useNotification } from "@kyvg/vue3-notification";
const props = defineProps({
    sale: {
        type: Object,
        required: true,
    },
});
const disabled = ref(false);
const { notify } = useNotification();
const { errors, emptyErrors, getErrors } = useErrors();

const products = ref({});
const payment_method = ref("");

const updateReturnProducts = ({ qty, productId }) => {
    if (!qty) {
        delete products.value[productId];
        return;
    }
    products.value[productId] = { qty, product_id: productId };
};

const handleSubmit = async () => {
    disabled.value = true;
    try {
        const { data } = await axios.post(`/sales/${props.sale.id}/returns`, {
            products: Object.values(products.value),
            payment_method: payment_method.value,
            resolution: "refund",
        });
        if (data?.data?.id) {
            notify({
                group: "foo",
                type: "success",
                title: "Devoluciones",
                text: "Devolución registrada.",
            });
            setTimeout(() => (window.location.href = "/returns"), 3000);
        }
        emptyErrors();
    } catch (error) {
        disabled.value = false;
        getErrors(error);
    }
};
</script>
