<template>
    <div class="flex items-center border-t border-gray-500 py-2 relative">
        <input
            v-model="term_search"
            class="
            appearance-none
            bg-transparent
            border-none
            w-full
            text-gray-700
            mr-3
            py-1
            pl-60
            leading-tight
            focus:outline-none
        "
            autocomplete="off"
            @keyup.prevent="search"
            @keyup.esc="close"
            @keyup.down="firstFocused"
            type="text"
            placeholder="Selecciona la categoría"
            aria-label="Full name"
        />

        <div
            class="absolute top-10 w-10/12 shadow-sm z-5 max-h-64 overflow-x-auto "
            v-if="items.length"
        >
            <ul class="bg-white w-full relative" ref="dropdown">
                <li class="mt-1" v-for="item in items" :key="item.id">
                    <a
                        class="p-1 pl-60 block w-full  focus:ring-2 focus:bg-gray-300 focus:border-transparent  font-mono font-light hover:bg-gray-300 cursor-pointer"
                        href="#"
                        @keyup.exact.down="nextFocused"
                        @keyup.exact.up="previousFocused"
                        @click.prevent="selectedCategory(item)"
                    >
                        {{ item.name }}
                    </a>
                </li>
            </ul>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        categories: {
            type: Array
        }
    },
    data() {
        return {
            items: [],
            term_search: "",
            category_id: null,
            selectedCategoryId: null,
            focusedIndex: 0
        };
    },
    methods: {
        search() {
            console.log("entro");
            this.items = this.categories.filter(category => {
                if (
                    category.name
                        .toUpperCase()
                        .indexOf(this.term_search.toUpperCase()) != -1
                )
                    return category;
            });
        },
        selectedCategory(category) {
            EventBus.$emit("selected-category", category);
            this.items = [];
            this.term_search = category.name.toUpperCase();
        },
        close() {
            this.items = [];
            this.term_search = "";
        },
        firstFocused() {
            this.focusedIndex = 0;
            this.$refs.dropdown.children[this.focusedIndex].children[0].focus();
        },
        nextFocused(event) {
            if (this.focusedIndex < this.items.length -1)
                this.focusedIndex = this.focusedIndex + 1;
            this.$refs.dropdown.children[this.focusedIndex].children[0].focus();
        },
        previousFocused() {
            if (this.focusedIndex > 0)
                this.focusedIndex = this.focusedIndex - 1;
            this.$refs.dropdown.children[this.focusedIndex].children[0].focus();
            
        }
    }
};
</script>
