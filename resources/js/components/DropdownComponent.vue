<template>
    <div
        class="
            block
            transition-all
            duration-500
            ease-in-out
            mt-4
            lg:mt-0
            text-gray-700
            md:hover:text-gray-900 md:hover:font-bold md:mr-4
        "
        :class="getZ"
    >
        <div
            @click="toggleOpen"
            class="relative md:text-base text-lg flex justify-between"
            :class="getZ"
        >
            {{ name }}
            <svg
                aria-hidden="true"
                focusable="false"
                data-prefix="fas"
                data-icon="chevron-down"
                class="inline-block"
                role="img"
                height="1em"
                width="1em"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 448 512"
            >
                <path
                    fill="currentColor"
                    d="M207.029 381.476L12.686 187.132c-9.373-9.373-9.373-24.569 0-33.941l22.667-22.667c9.357-9.357 24.522-9.375 33.901-.04L224 284.505l154.745-154.021c9.379-9.335 24.544-9.317 33.901.04l22.667 22.667c9.373 9.373 9.373 24.569 0 33.941L240.971 381.476c-9.373 9.372-24.569 9.372-33.942 0z"
                ></path>
            </svg>
        </div>
        <button
            v-if="isOpen"
            tabindex="-1"
            @click="isOpen = false"
            class="
                hidden
                sm:block
                fixed
                inset-0
                h-full
                w-full
                opacity-50
                cursor-default
                md:z-5
                focus:outline-none
            "
        ></button>
        <transition
            name="expand"
            @enter="enter"
            @after-enter="afterEnter"
            @leave="leave"
        >
            <div
                v-if="isOpen"
                :ref="name"
                class="
                    w-full
                    md:bg-white md:w-40
                    rounded-md
                    md:absolute
                    md:z-10
                    md:shadow-md
                    md:mt-3
                    md:p-2
                    md:text-center
                "
            >
                <a
                    v-for="item in items"
                    :key="item.name"
                    :href="item.url"
                    class="
                        sm:pl-1
                        pl-2
                        text-gray-800
                        bg-gray-300
                        font-extralight
                        block
                        md:text-gray-800 md:mt-0
                        py-2
                        md:border-none
                        border-b border-white
                        md:bg-transparent md:p-1 md:hover:text-red-400
                    "
                >
                    {{ item.name }}
                </a>
            </div>
        </transition>
    </div>
</template>
<script>
export default {
    data() {
        return {
            isOpen: false,
        };
    },
    props: {
        items: {
            type: Array,
        },
        name: {
            type: String,
        },
    },
    created() {
        const handleEscape = (e) => {
            if (e.key == "Esc" || e.key == "Escape") {
                this.isOpen = false;
            }
        };

        document.addEventListener("keydown", handleEscape);

        this.$once("hook:beforeDestroy", () => {
            document.removeEventListener("keydown", handleEscape);
        });
        // EventBus.$on("open", (name) => {
        //     if (name != this.name) this.isOpen = false;
        // });
    },
    watch: {
        // isOpen() {
        //     EventBus.$emit("open", this.name);
        // },
    },
    computed: {
        getZ() {
            if (
                navigator.userAgent.match(/Android/i) ||
                navigator.userAgent.match(/webOS/i) ||
                navigator.userAgent.match(/iPhone/i) ||
                navigator.userAgent.match(/iPad/i) ||
                navigator.userAgent.match(/iPod/i) ||
                navigator.userAgent.match(/BlackBerry/i) ||
                navigator.userAgent.match(/Windows Phone/i)
            )
                return ["z-10"];

            return this.isOpen ? ["z-10"] : ["z-0"];
        },
    },
    methods: {
        toggleOpen() {
            this.isOpen = !this.isOpen;
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
<style scoped>

.expand-enter-active,.expand-leave-active {
    transition: height 0.5s ease-in-out;
    overflow: hidden;
}
</style>
