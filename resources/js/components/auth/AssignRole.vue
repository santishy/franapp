<template>
    <div class="bg-white rounded-sm shadow-sm p-2">
        <h3
            class="
                form-header
                p-2
                text-dark text-center text-xl
                font-extralight
                text-blue-800
            "
        >
            Asignar roles
        </h3>
        <div v-for="role in roles" :key="role.id">
            <label class="inline-flex items-center justify-center">
                <input
                    type="checkbox"
                    class="form-checkbox"
                    @change="toggleRole($event, role.id)"
                    :checked="isChecked(role)"
                />
                <span class="ml-2">{{ role.name.toUpperCase() }}</span>
            </label>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        roles: {
            type: Array,
        },
        hasRoles: {
            type: Array,
        },
    },
    methods: {
        toggleRole(event, id) {
            if (event.target.checked) return EventBus.$emit("assign-role", id);
            return EventBus.$emit("remove-role", id);
        },
        isChecked(role) {
            if (this.hasRoles)
                return this.hasRoles.some((element) => role.id === element.id);
        },
    },
    computed: {},
};
</script>
