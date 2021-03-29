<template>
    <div class="mt-24 md:mt-32 bg-white rounded shadow p-4 md:w-4/12">
        <div v-for="role in roles" :key="role.id">
            <label class="inline-flex items-center">
                <input
                    type="checkbox"
                    class="form-checkbox"
                    @change="toggleRole($event, role.id)"
                />
                <span class="ml-2">{{ role.name }}</span>
            </label>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        roles: {
            type: Array
        }
    },
    methods: {
        toggleRole(event, id) {
            if (event.target.checked) return EventBus.$emit("assign-role", id);
            return EventBus.$emit("remove-role", id);
        }
    }
};
</script>
