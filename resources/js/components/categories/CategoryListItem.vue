<template>
    <li class="flex justify-between px-4">
        {{ category.name }}
        <button @click.prevent="selectedCategory">
            <span>
                <i :class="toggleCircle"></i>
            </span>
        </button>
    </li>
</template>
<script>
export default {
    props: {
        category: {
            type: Object,
            required: true
        }
    },
    created() {
        EventBus.$on("selected-category", category => {
            if (category.id != this.category.id) {
                this.fill = false;
            }
        });
    },
    data() {
        return {
            fill: false
        };
    },
    methods: {
        selectedCategory() {
            this.fill = true;
            EventBus.$emit("selected-category", this.category);
        }
    },
    computed: {
        toggleCircle() {
            return this.fill ? "fas fa-circle" : "far fa-circle";
        }
    }
};
</script>
