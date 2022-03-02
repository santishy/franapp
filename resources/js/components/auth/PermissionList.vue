<template>
    <div
        class="
            rounded
            bg-white
            shadow
            
            px-4
            grid
            sm:grid-cols-3
            grid-cols-2
        "
    >
        <div
            v-if="role != null"
            class="
                w-full
                text-xl text-blue-800
                font-extralight
                form-header
                border-gray-300 border-b-2
                sm:col-span-3
                col-span-2
                mb-2
                p-2
            "
        >
            Agregar permisos al rol:
            <span v-if="!!role" class="text-dark font-semibold">{{
                role.name.toUpperCase()
            }}</span>
        </div>
        <div
            v-for="permission in permissions"
            :key="permission.id"
            class="sm:mr-8 mb-1"
        >
            <label class="inline-flex items-center">
                <input
                    @change="togglePermission(permission, $event)"
                    type="checkbox"
                    class="form-checkbox"
                    :checked="isChecked(permission.name)"
                />
                <span class="ml-2 text-gray-900 sm:text-xs text-base">{{
                    permission.translate.toUpperCase()
                }}</span>
            </label>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        permissions: {
            type: Array,
        },
    },
    data: () => ({
        role: false,
    }),
    created() {
        EventBus.$on("permissions-found", (role) => {
            Vue.set(this.$data, "role", role.data);
        });
    },
    methods: {
        isChecked(name) {
            if (!!this.role) {
                return this.role.permissions.some((permission, index) => {
                    if (permission.name == name) {
                        return true;
                    }
                });
            }
        },
        togglePermission(permission, event) {
            let method = "post";
            var params = { permission_id: permission.id };
            if (!event.target.checked) {
                method = "delete";
                params = { data: params };
            }
            axios[method](`/roles/${this.role.id}/permissions`, params)
                .then((res) => {
                    this.role.permissions = res.data.permissions;
                })
                .catch((err) => {
                    console.log(err);
                });
        },
    },
};
</script>
