<template>
    <a
        href="#responsive-header"
        class="block  mt-0 transition-all duration-500 ease-in-out mt-4 lg:inline-block lg:mt-0 text-gray-200 md:hover:text-white mr-4"
    >
        <div @click="isOpen = !isOpen" class="z-10 relative md:text-base text-lg">
            {{ name }}
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
            <a
                v-for="item in items"
                :key="item.name"
                :href="item.url"
                class="md:pl-1 text-gray-700 bg-red-400 font-bold block md:text-gray-800 md:mt-0 py-2 md:border-none border-b border-red-500  md:bg-transparent md:p-2 md:hover:text-red-400"
                >
                    <div class="md:hidden inline-block mx-2">
                        <i :class="getIcon(item.name)"></i>
                    </div>
                    
                    {{ item.name }}
                
                </a
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
    props: {
        items: {
            type: Array
        },
        name: {
            type: String
        }
    },
    created() {
        const handleEscape = e => {
            if (e.key == "Esc" || e.key == "Escape") {
                this.isOpen = false;
            }
        };

        document.addEventListener("keydown", handleEscape);

        this.$once("hook:beforeDestroy", () => {
            document.removeEventListener("keydown", handleEscape);
        });
    },
    methods:{
        getIcon($key){
            if($key === 'Añadir')
                return 'fas fa-plus';
            else if($key == 'Listar')
                return 'fas fa-list';
            
        }
    }
};
</script>
