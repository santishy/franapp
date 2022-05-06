<template>
    <transition
        name="expand"
        class=""
        @enter="enter"
        @after-enter="afterEnter"
        @leave="leave"
    >
        <div
            v-if="show"
            class="
                w-full
                
                bg-blue-100
                border-t border-b border-red-500
                text-red-700
                px-4
                py-3
            "
            role="alert"
        >
            <p class="font-bold">Se detecto los siguientes errores:</p>
            <p v-for="error in errorsFound" class="text-sm" :key="error">
                {{ error }}
            </p>
        </div>
    </transition>
</template>

<script>
export default {
    data() {
        return {
            show: false,
        };
    },
    props: {
        errorsFound: {
            type: Array,
        },
        errorsLength: {
            type: Number,
        },
    },
    watch: {
        errorsFound: {
            deep: true,
            async handler() {
                if (this.errorsFound) {
                    this.show = true;
                }

                await setTimeout(() => {
                    this.show = false;
                    EventBus.$emit("emptyErrors");
                }, 5000);
            },
        },
    },
    methods:{
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
    }
};
</script>
