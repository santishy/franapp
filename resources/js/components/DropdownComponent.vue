<template>
    <a
        href="#responsive-header"
        class="block  mt-0 transition-all duration-500 ease-in-out mt-4 lg:inline-block lg:mt-0 text-gray-200 hover:text-white mr-4"
    >
        <div @click="isOpen = !isOpen" class="z-10 relative">
            Productos
        </div>
        <button
            v-if="isOpen"
            tabindex="-1"
            @click="isOpen = false"
            class="hidden sm:block fixed inset-0 h-full w-full bg-black opacity-50 cursor-default"
        ></button>
        <div
            v-if="isOpen"
            class="bg-transparent w-full md:bg-white static md:w-40 rounded-md md:absolute md:shadow-md md:mt-3 "
        >
            <a v-for="item in items" :key="item.name" :href="item.url" class="pl-1 text-white block md:text-gray-800 md:p-2 hover:text-red-400"
                >{{item.name}}</a
            >
        </div>
    </a>
</template>
<script>
export default {
    data() {
        return {
            isOpen: false
        };
    },
    props:{
        items:{
            type:Array
        }
    },
    created() {
        console.log(this.items)
        const handleEscape = e => {
            if (e.key == "Esc" || e.key == "Escape") {
                this.isOpen = false;
            }
        };

        document.addEventListener("keydown", handleEscape);

        this.$once("hook:beforeDestroy", () => {
            document.removeEventListener("keydown", handleEscape);
        });
    }
};
</script>
