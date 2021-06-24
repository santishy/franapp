<template>
    <nav-component>
        <div class="flex flex-wrap items-baseline">
            <registration-form
                class="mr-4"
                :inventories="inventories"
                method="post"
                uri="/register"
            >
            </registration-form>
            <assign-role :roles="roles" class="self-start"></assign-role>
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
        }
    }
};
</script>
