<template>
    <div class="h-screen bg-white shadow fixed inset-y-0 left-0 w-64 ">
        <div class="py-4 min-h-screen ">
            <h5 class="text-xl w-full p-2 mb-5 text-center font-extrabold text-blue-800">Panel administrador</h5>
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