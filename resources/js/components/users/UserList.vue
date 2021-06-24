<template>
    <div
        class="md:mt-32  max-w-max flex justify-center sm:overflow-x-hidden overflow-x-auto"
    >
        <table class="table-auto text-center  bg-white shadow rounded ">
            <thead class="bg-gray-400">
                <th class="border px-4 py-2">Nombre</th>
                <th class="border px-4 py-2">Email</th>
                <th class="border px-4 py-2">Rols</th>
                <th class="border px-4 py-2">Acciones</th>
            </thead>
            <tbody>
                <tr v-for="user in users" :key="user.id">
                    <td class="border px-4 py-2">{{ user.name }}</td>
                    <td class="border px-4 py-2">{{ user.email }}</td>
                    <td class="border px-4 py-2">{{ roles(user.roles) }}</td>
                    <td class="border px-4 py-2">
                        <a :href="`/users/${user.id}/edit`">
                            <i class="fas fa-user-edit"></i>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
export default {
    data: () => ({
        users: []
    }),
    mounted() {
        this.getUsers();
    },
    methods: {
        roles(roles) {
            let extraction = [];
            roles.forEach(({ name }) => {
                extraction.push(name);
            });
            return extraction.join();
        },
        getUsers() {
            axios
                .get("/users?axios=" + Math.random(10))
                .then(res => {
                    if (res.data.length) this.users = res.data;
                })
                
        }
    }
};
</script>
