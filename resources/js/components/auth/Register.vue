<template>
    <nav-component>
        <div class=" px-4 mx-auto grid grid-cols-2 gap-4 grid-flow-col" >
            <registration-form
                class=""
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
        uri: {
            type: String
        }
    },
    computed:{
        definePermission(){
            if(this.method.toUpperCase() === 'POST' )
                return 'create user';
            return 'edit user';
        }
    }
};
</script>
