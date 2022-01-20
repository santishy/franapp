<template>
    <div class="h-screen max-h-screen overflow-y-auto  bg-gray-100 shadow-sm fixed inset-y-0 left-0 w-64 ">
        <div class="min-h-screen ">
            <h5
                class="
                    text-2xl
                    w-full
                    mb-5
                    py-3
                    flex 
                    justify-center
                    bg-white
                "
            >
                <img :src="logo" class="object-contain md:object-scale-down w-24">
            </h5>
            <slot />
        </div>
    </div>
</template>
<script>
export default {
    props: {
        inventoryMenu: {
            type: Array,
        },
    },
    computed: {
        logo(){
            return document.querySelector('meta[name="logo_path"]').content || '';
        }
    }
};
</script>
