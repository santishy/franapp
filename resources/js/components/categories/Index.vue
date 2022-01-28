<template>
    <nav-component>
        <div class="flex flex-wrap sm:items-baseline sm:w-full mx-4 rounded-sm">
            <category-form 
                class="sm:self-start "
                uri='/categories'
            ></category-form>
            <div class=" sm:ml-4 w-full sm:w-6/12 p-4 bg-white rounded-sm">
                <div class="bg-gray-300 shadow-inner p-2 rounded-sm">
                <category-list ></category-list>
                </div>
            </div>
        </div>
    </nav-component>
</template>
<script>

import NavComponent from "../NavComponent.vue";

export default {
    components: {
        NavComponent
    }
};
</script>
