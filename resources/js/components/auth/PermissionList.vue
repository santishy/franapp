<template>
    <div
        class="rounded bg-white shadow p-4 mt-24 md:mt-32 flex-wrap flex  items-center "
    >
        <div
            v-for="permission in permissions"
            :key="permission.id"
            class="mr-8"
        >
            <label class="inline-flex items-center">
                <input type="checkbox" class="form-checkbox"/>
                <span class="ml-2">{{ permission.name }}</span>
            </label>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        permissions: {
            type: Array
        }
    }
};
</script>
