<template>
    <nav-component>
        <div
            v-can="'view users'"
            class="
                flex
                justify-center
                shadow-sm
                w-full
                rounded
                max-w-full
                sm:overflow-x-hidden
                overflow-x-auto
                px-4
            "
        >
            <table
                class="
                    min-w-full
                    border-collapse
                    block
                    md:table
                    shadow-sm
                    text-center
                    rounded-lg
                "
            >
                <thead class="block md:table-header-group">
                    <tr
                        class="
                            border-b border-gray-500
                            rounded-t-sm
                            md:border-none
                            block
                            md:table-row
                            absolute
                            -top-full
                            md:top-auto
                            -left-full
                            md:left-auto md:relative
                        "
                    >
                        <th
                            class="
                                bg-blue-700
                                p-2
                                text-white
                                font-semibold
                                md:border md:border-grey-500
                                text-left
                                block
                                md:table-cell
                            "
                        >
                            Nombre
                        </th>
                        <th
                            class="
                                bg-blue-700
                                p-2
                                text-white
                                font-semibold
                                md:border md:border-grey-500
                                text-left
                                block
                                md:table-cell
                            "
                        >
                            Email
                        </th>
                        <th
                            class="
                                bg-blue-700
                                p-2
                                text-white
                                font-semibold
                                md:border md:border-grey-500
                                text-left
                                block
                                md:table-cell
                            "
                        >
                            Rols
                        </th>
                        <th
                            class="
                                bg-blue-700
                                p-2
                                text-white
                                font-semibold
                                md:border md:border-grey-500
                                text-left
                                block
                                md:table-cell
                            "
                        >
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody class="block md:table-row-group alternate-table-row">
                    <tr
                        v-for="user in users"
                        :key="user.id"
                        class="
                            bg-white
                            border-b border-gray-400
                            md:border-none
                            block
                            md:table-row
                        "
                    >
                        <td
                            class="
                                p-2
                                md:border md:border-grey-500
                                text-left
                                block
                                md:table-cell
                            "
                        >
                            <span class="inline-block w-1/3 md:hidden font-bold"
                                >Nombre</span
                            >
                            {{ user.name }}
                        </td>
                        <td
                            class="
                                p-2
                                md:border md:border-grey-500
                                text-left
                                block
                                md:table-cell
                            "
                        >
                            <span class="inline-block w-1/3 md:hidden font-bold">Correo</span
                            >
                            {{ user.email }}
                        </td>
                        <td
                            class="
                                p-2
                                md:border md:border-grey-500
                                text-left
                                block
                                md:table-cell
                            "
                        >
                            <span class="inline-block w-1/3 md:hidden font-bold">Rols</span
                            >
                            {{ roles(user.roles) }}
                        </td>
                        <td
                            class="
                                p-2
                                md:border md:border-grey-500
                                text-left
                                block
                                md:table-cell
                            "
                        >
                            <span class="inline-block w-1/3 md:hidden font-bold">Acciones</span
                            >
                            
                                <a
                                    class="mr-2 inline-block"
                                    :href="`/users/${user.id}/edit`"
                                >
                                    <user-edit-icon></user-edit-icon>
                                </a>
                                <form action="/impersonations" method="post" class="inline-block">
                                    <input
                                        type="hidden"
                                        name="user_id"
                                        :value="`${user.id}`"
                                    />
                                    <input
                                        type="hidden"
                                        name="_token"
                                        :value="csrf"
                                    />
                                    <button><ninja-icon></ninja-icon></button>
                                </form>
                           
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </nav-component>
</template>
<script>
import NavComponent from "../NavComponent.vue";
import UserEditIcon from "../icons/UserEditIcon.vue";
import NinjaIcon from "../icons/NinjaIcon.vue";
export default {
    components: { NavComponent, NinjaIcon, UserEditIcon },
    data: () => ({
        users: [],
        csrf: document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content"),
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
            axios.get("/users?axios=" + Math.random(10)).then((res) => {
                if (res.data.length) this.users = res.data;
            });
        },
    },
};
</script>
