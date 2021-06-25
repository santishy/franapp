<template>
    <nav-component>
        <div class="flex flex-wrap items-baseline">
            <registration-form
                class="mr-4"
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
            ></assign-role>
        </div>
    </nav-component>
</template>
<script>
import NavComponent from "../NavComponent.vue";

export default {
    components: { NavComponent },
    props: {
        roles: {
            type: Array
        },
        inventories: {
            type: Array
        },
        editableUser: {
            type: Object
        },
        hasRoles: {
            type: Array
        },
        method: {
            type: String
        },
        uri:{
            type:String
        }
    }
};
</script>
