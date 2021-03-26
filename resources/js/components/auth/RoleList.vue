<template>
    <div class="bg-white rounded shadow p-4 ">
        <ul class="list-inside bg-gray-200">
            <li v-for="role in localRoles" :key="role.id">
                <a
                    href="#"
                    @click.prevent="getPermissions(role.id)"
                    class="w-full p-2 block border-white border-b-2 "
                    >{{ role.name }}</a
                >
            </li>
        </ul>
    </div>
</template>
<script>
export default {
    data: () => ({
        localRoles: []
    }),
    props: {
        roles: {
            type: Array
        }
    },
    mounted() {
        this.localRoles = this.roles;
        EventBus.$on("role-created", role => {
            this.roles.unshift(role);
        });
    },
    methods: {
        getPermissions(id) {
            this.unchekedAll();
            axios
                .get(`/roles/${id}`, {
                    params: {
                        include: "permissions"
                    }
                })
                .then(response => {
                    EventBus.$emit("permissions-found", response.data);
                    console.log('escrito')
                });
        },
        // deselecciona todos los checkbox que se encuentren en ese momento
        unchekedAll() {
            document.querySelectorAll(".form-checkbox").forEach(element => {
                element.checked = false;
                console.log(element.checked)
            });
            
        }
    }
};
</script>
