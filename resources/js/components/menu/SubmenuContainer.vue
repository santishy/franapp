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
                text-blue-800
                justify-between
            "
            @click.prevent="toggle"
            ><span class="mr-1 font-mono text-lg flex justify-center items-end"
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
            <ul class="divide-y-2 divide-gray-200" v-if="show">
                <slot name="list"> </slot>
            </ul>
            <!-- <ul class=" divide-y-2 divide-gray-200" v-if="show">
                <li v-for="item in itemsMenu" :key="item.name" class="bg-white">
                    <a
                        :href="item.url"
                        class="
                            block
                            w-full
                            text-gray-800
                            subpixel-antialiased 
                            hover:bg-gray-200
                            font-mono
                            p-2
                            pl-6
                            text-sm
                        "
                        >{{ item.name }}</a
                    >
                </li>
            </ul> -->
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
            console.log('hello world')
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
