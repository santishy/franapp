<template>
    <div class="w-full px-0">
        <a href="#" class="flex border items-center w-full space-y-0 px-3 py-2 font-mono text-secondary justify-between"
            @click.prevent="toggle">
            <div class="font-mono flex items-center justify-center">
                <span class="mr-1">
                    <slot name="descriptive-icon"></slot>
                </span><span class="leading-none">{{ name }}</span>
            </div>
            <slot name="icon"></slot>
        </a>

        <transition name="expand" class="" @enter="enter" @after-enter="afterEnter" @leave="leave">
            <ul class="divide-y divide-white bg-slate-50 text-slate-700" v-if="show">
                <slot name="list"> </slot>
            </ul>
        </transition>
    </div>
</template>

<script>
export default {
    props: ["name"],
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
};
</script>
