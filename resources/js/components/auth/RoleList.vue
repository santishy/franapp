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
            console.log("se ejecuto");
            this.roles.unshift(role);
        });
    },
    methods: {
        getPermissions(id) {
            axios.get(`/roles/${id}`, {
                params: {
                    include: "permissions"
                }
            })
            .then( response => {
                console.log(response);
            });
        }
    }
};
</script>
