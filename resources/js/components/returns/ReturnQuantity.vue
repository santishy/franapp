<script setup>
import { ref, watch } from "vue";
import CustomInput from "../common/CustomInput.vue";
const props = defineProps({
    product: {
        type: Object,
        required: true,
    },
});
const emit = defineEmits(["update:returnQty"]);

const qty = ref(null);

watch(qty, () => {
    emit("update:returnQty", {
        productId: props.product.id,
        qty: qty.value,
    });
});
</script>

<template>
    <div class="flex justify-center">
        <CustomInput v-model="qty" class="md:w-10/12 w-full" />
    </div>
</template>
