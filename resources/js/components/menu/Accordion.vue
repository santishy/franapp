<template>
    <div class="w-full px-0">
        <a href="#" class="
                flex
                items-center
                w-full
                space-y-0
                px-3
                py-1
                font-mono
                justify-between
            " :class="getTextColor" @click.prevent="toggle">
            <div :class="getTextSize" class="mr-1 font-mono flex justify-center items-center">
                <slot name="descriptive-icon"></slot> <span class="h-5 block">{{ name }}</span>
            </div>
            <slot name="icon"></slot>
        </a>
        <transition name="expand" class="" @enter="enter" @after-enter="afterEnter" @leave="leave">
            <ul :class="[isSubmenu ? 'divide-slate-50' : 'divide-slate-50']" class="divide-y-2" v-if="show">
                <li v-for="item in itemsMenu" :key="item.name" :class="[isSubmenu ? 'bg-slate-100' : 'bg-slate-100']"
                    class="text-sm hover:bg-slate-100">
                    <a :href="item.url" class="
                            w-full
                            subpixel-antialiased
                            font-mono
                            text-slate-800
                            pr-2
                            py-2
                            pl-8
                            flex flex-wrap
                            items-center
                        ">
                        <arrow-narrow-right-icon class="mr-2 h-5 w-5 p-1 rounded-sm" />
                        {{ item.name }}
                    </a>
                </li>
            </ul>
        </transition>
    </div>
</template>

<script>
import ArrowNarrowRightIcon from "../icons/ArrowNarrowRightIcon.vue";
export default {
    components: {
        ArrowNarrowRightIcon,
    },
    props: ["itemsMenu", "name", "isSubmenu"],
    data() {
        return {
            show: false,
        };
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
            return this.isSubmenu ? "text-slate-600 " : "text-slate-800";
        },
        getBackgroundColor() {
            return this.isSubmenu
                ? "bg-white hover:text-gray-900"
                : "hover:bg-slate-200";
        },
        getTextSize() {
            return this.isSubmenu ? "text-sm" : "";
        },
    },
};
</script>
