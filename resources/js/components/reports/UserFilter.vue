<template>
    <select
        v-model="selectedUser"
        @change="onSelectedUser"
        class="block w-96 px-3 py-2.5 bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded focus:ring-brand focus:border-brand shadow-xs placeholder:text-body"
    >
        <option :value="''" selected>Todos los usuarios</option>
        <option v-for="user in users" :key="user.id" :value="`${user.id}`">
            {{ user.name }}
        </option>
    </select>
</template>
<script setup>
import { ref } from "vue";
const emit = defineEmits(["user-change"]);
defineProps({
    users: {
        type: Array,
        required: true,
    },
});
const selectedUser = ref("");

const onSelectedUser = () => {
    const userFilter = selectedUser.value
        ? { [`filter[user]`]: selectedUser.value }
        : {};
    emit("user-change", userFilter);
};
</script>
