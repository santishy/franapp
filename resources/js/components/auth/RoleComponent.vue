<template>
    <nav-component>
        <div
            class="
                w-full
                px-4
                mx-auto
                grid grid-cols-8
                sm:gap-4 sm:grid-flow-col sm:auto-cols-auto
                auto-rows-auto
            "
            v-can="'create role'"
        >
            <create-new-role
                class="sm:col-span-3 col-span-8 row-start-2 sm:row-start-1"
                :roles="roles"
            >
            </create-new-role>
            <permission-list
                class="sm:col-span-5 col-span-8"
                :permissions="permissions"
            >
            </permission-list>
        </div>
    </nav-component>
</template>
<script>
import NavComponent from "../NavComponent.vue";
export default {
    components: { NavComponent },
    props: {
        permissions: {
            type: Array,
        },
        roles: {
            type: Array,
        },
    },
};
</script>
