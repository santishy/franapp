<template>
    <div
        class="rounded bg-white shadow py-2 px-4 mt-24 md:mt-32 flex-wrap flex  items-center "
    >
        <div
            v-if="rolePermissions != null"
            class="w-full text-xl border-gray-300 border-b-2 pb-3"
        >
            Agregar permisos al rol:
            <!-- <span v-if="!!rolePermissios" class="text-dark font-semibold">{{
              //  role.name.toUpperCase()
            }}</span> -->
        </div>
        <div
            v-for="permission in permissions"
            :key="permission.id"
            class="mr-8"
        >
            <label class="inline-flex items-center">
                <input
                    @change="togglePermission(permission, $event)"
                    type="checkbox"
                    class="form-checkbox"
                    :checked="isChecked(permission.name)"
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
        rolePermissions: false,
        temp:[]
    }),
    created() {
        EventBus.$on("permissions-found", role => {
            Vue.set(this.$data, "rolePermissions", role.data);
        });
    },
    methods: {
        isChecked(name) {
            if (!!this.role) {
                return this.role.permissions.some( (permission,index) => {
                    if(permission.name == name)
                    {
                        return true;
                    }
                })
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
                .then(res => {})
                .catch(err => {
                    console.log(err);
                });
        },
        unchekedAll() {
            document.querySelectorAll(".form-checkbox").forEach(element => {
                element.checked = "";
            });
        }
    }
};
</script>
