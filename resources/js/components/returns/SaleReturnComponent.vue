<template>
    <layout-component>
        <div class="px-4">
            <SaleReturnForm :sale="sale" />
        </div>
    </layout-component>
</template>
<script setup>
import SaleReturnForm from "./SaleReturnForm.vue";
defineProps({
    sale: {
        type: Object,
        required: true,
    },
});
</script>
