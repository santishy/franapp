<template>
    <div>
        <input
            :type="type"
            :value="modelValue"
            v-bind="$attrs"
            @input="$emit('update:modelValue', $event.target.value)"
            @blur="$emit('blur')"
            class="bg-slate-100 rounded border-2 border-slate-200 focus:border-sky-500 focus:outline-none p-1"
        />
    </div>
</template>
<script setup>
defineProps({
    modelValue: {
        type: String,
    },
    type: {
        type: String,
    },
});
</script>
