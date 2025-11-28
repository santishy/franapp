<template>
    <layout-component>
        <div
            class="
                px-4
                mx-auto
                grid grid-cols-1
                sm:grid sm:grid-cols-2 sm:gap-4 sm:grid-flow-col
            "
        >
            <registration-form
                class="row-start-2 sm:row-start-1 sm:mt-0 mt-4"
                :inventories="inventories"
                :method="method"
                :editable-user="editableUser"
                :uri="uri"
            >
            </registration-form>
            <assign-role
                :roles="roles"
                class="self-start"
                :has-roles="hasRoles"
                v-can="definePermission"
            ></assign-role>
        </div>
    </layout-component>
</template>
<script>

export default {
    props: {
        roles: {
            type: Array,
        },
        inventories: {
            type: Array,
        },
        editableUser: {
            type: Object,
        },
        hasRoles: {
            type: Array,
        },
        method: {
            type: String,
        },
        uri: {
            type: String,
        },
    },
    computed: {
        definePermission() {
            if (this.method.toUpperCase() === "POST") return "create user";
            return "edit user";
        },
    },
};
</script>
