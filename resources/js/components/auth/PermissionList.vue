<template>
    <div
        class="rounded bg-white shadow py-2 px-4 mt-24 md:mt-32 flex-wrap flex  items-center "
    >
        <div
            v-if="role != null"
            class="w-full text-xl border-gray-300 border-b-2 pb-3"
        >
            Agregar permisos al rol:
            <span v-if="!!role" class="text-dark font-semibold">{{
                role.name.toUpperCase()
            }}</span>
        </div>
        <div
            v-for="permission in permissions"
            :key="permission.id"
            class="mr-8"
            @change="togglePermission(permission, $event)"
        >
            <label class="inline-flex items-center">
                <input
                    type="checkbox"
                    class="form-checkbox"
                    :checked="isChecked(permission.id)"
                />
                <span class="ml-2">{{ permission.name }}</span>
            </label>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        permissions: {
            type: Array
        }
    },
    data: () => ({
        role: false
    }),
    created() {
        EventBus.$on("permissions-found", role => {
            //this.role = role.data;
            Vue.set(this.$data, "role", role.data);
        });
    },
    methods: {
        isChecked(id) {
            if (!!this.role)
                return this.role.permissions.some((permission, index) => {
                    if (permission.id == id) {
                        return true;
                    }
                    console.log(index);
                });
        },
        togglePermission(permission, event) {
            let method = "delete";
            if (event.target.checked) method = "post";
            axios[method](`/roles/${this.role.id}/permissions`, {
                permission_id: permission.id
            })
                .then(res => {
                    console.log(res);
                })
                .catch(err => {
                    console.log(err);
                });
        }
    }
};
</script>
