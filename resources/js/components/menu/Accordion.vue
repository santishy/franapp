<template>
    <div class="w-full px-0">
        <a
            href="#"
            class="
                flex
                items-center
                w-full
                space-y-0
                px-3
                py-2
                font-mono
                justify-between
            "
            :class="getTextColor"
            @click.prevent="toggle"
            ><span
                :class="getTextSize"
                class="mr-1 font-mono flex justify-center items-end"
                ><slot name="descriptive-icon"></slot> {{ name }}</span
            ><slot name="icon"></slot
        ></a>
        <transition
            name="expand"
            class=""
            @enter="enter"
            @after-enter="afterEnter"
            @leave="leave"
        >
            <ul
                :class="[isSubmenu ? 'divide-gray-800' : 'divide-gray-200']"
                class="divide-y-2"
                v-if="show"
            >
                <li v-for="item in itemsMenu" :key="item.name" class="bg-white">
                    <a
                        :href="item.url"
                        :class="[
                            getTextSize, 
                            getBackgroundColor, 
                            getTextColor,
                            isSubmenu ? 'pl-10' : 'pl-6'
                        ]"
                        class="
                            block
                            w-full
                            subpixel-antialiased
                            font-mono
                            pr-2
                            py-2
                        "
                        >{{ item.name }}</a
                    >
                </li>
            </ul>
        </transition>
    </div>
</template>

<script>
export default {
    props: ["itemsMenu", "name", "isSubmenu"],
    data() {
        return {
            show: false,
        };
    },
    created() {
        console.log("isSubmenu: " + this.isSubmenu);
    },
    methods: {
        toggle() {
            this.show = !this.show;
        },
        enter(el) {
            el.style.height = "auto";
            const height = getComputedStyle(el).height;
            el.style.height = 0;
            //getComputedStyle(el);
            setTimeout(() => {
                el.style.height = height;
            });
        },
        afterEnter(el) {
            el.style.height = "auto";
        },
        leave(el) {
            el.style.height = getComputedStyle(el).height;
            // getComputedStyle(el);
            setTimeout(() => {
                el.style.height = 0;
            });
        },
    },
    computed: {
        getTextColor() {
            return this.isSubmenu ? "text-white" : "text-gray-800";
        },
        getBackgroundColor() {
            return this.isSubmenu
                ? "bg-gray-700 hover:text-gray-900"
                : "hover:bg-gray-200";
        },
        getTextSize() {
            return this.isSubmenu ? "text-sm" : "text-lg";
        },
    },
};
</script>
