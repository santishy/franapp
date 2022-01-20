<template>
    <div class="w-full px-3">
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
            ><span
                class="
                    mr-1
                    font-mono font-semibold
                    flex
                    justify-center
                    items-end
                "
                ><slot name="descriptive-icon"></slot> {{ name }}</span
            ><slot name="icon"></slot
        ></a>
        <transition-group
            tag="ul"
            v-if="show"
            class="mb-2 divide-y divide-gray-200"
            name="fade"
        >
            <li v-for="item in itemsMenu" :key="item.name" class="bg-white">
                <a
                    :href="item.url"
                    class="
                        block
                        w-full
                        text-blue-700
                        font-mono
                        p-1
                        pl-12
                        text-sm
                    "
                    >{{ item.name }}</a
                >
            </li>
        </transition-group>
    </div>
</template>

<script>
export default {
    props: ["itemsMenu", "name"],
    data() {
        return {
            show: false,
        };
    },
    methods: {
        toggle() {
            this.show = !this.show;
        },
    },
};
</script>
