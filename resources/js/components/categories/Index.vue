<template>
    <nav-component>
        <div class="flex flex-wrap items-baseline">
            <category-form class="self-start"></category-form>
            <div class="ml-6 w-2/4">
                <category-list></category-list>
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
