<template>
    <div class="h-screen bg-gray-100 shadow fixed inset-y-0 left-0 w-64 py-6 ">
        <div class="min-h-screen ">
            <h5 class="text-2xl w-full mb-5 text-center font-extrabold text-blue-800 py-2">ISCO</h5>
            <slot/>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        inventoryMenu: {
            type:Array
        }
    }
}
</script>