<template>
    <div
        class="rounded bg-white shadow p-4 mt-24 md:mt-32 flex-wrap flex  items-center "
    >
        <div v-if="role != null" class="w-full">
            Agregar permisos al rol: <span>{{ role.name }}</span>
        </div>
        <div
            v-for="permission in permissions"
            :key="permission.id"
            class="mr-8"
            :checked="isChecked"
            @change="togglePermission(permission)"
        >
            <label class="inline-flex items-center">
                <input type="checkbox" class="form-checkbox" />
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
        role: null
    }),
    created() {
        EventBus.$on("permissions-found", role => {
            this.role = role.data;
        });
    },
    methods:{
        isChecked(permission){
            return this.permissions.includes({'id':permission.id,'name':permission.name})
        },
        togglePermission:function(permission,event){
            console.log(event)
            //axios[method](`/roles/${this.role.id}/permissions`)

        }
    }
};
</script>
