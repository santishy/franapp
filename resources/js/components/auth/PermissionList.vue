<template>
    <div class="rounded w-8/12 bg-white shadow p-4 mt-24 md:mt-32">
        <div v-for="permission in permissions" :key="permission.id">
            <label class="inline-flex items-center">
                <input type="checkbox" class="form-checkbox" checked />
                <span class="ml-2">{{permission.name}}</span>
            </label>
        </div>
    </div>
</template>

<script>
export default {
    props:{
        permissions:{
            type:Array
        }
    }
}
</script>