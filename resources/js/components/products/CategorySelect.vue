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
            @focus="allCategories"
            @keyup.prevent="search"
            @keyup.esc.prevent="close"
            @keyup.down.prevent="nextFocused"
            @keyup.up.prevent="previousFocused"
            @keyup.enter.prevent="selectedCategory(focusedIndex, $event)"
            type="text"
            placeholder="Selecciona la categoría"
            aria-label="Full name"
        />
        <label
            for=""
            class="
                absolute
                pl-0
                bg-gray-200
                h-full
                flex
                items-center
                w-56
                justify-center
                text-indigo-800
                font-mono font-semibold
            "
            >Categoría</label
        >
        <div
            class="
                absolute
                top-10
                w-2/3
                shadow
                z-5
                max-h-64
                overflow-x-auto
                ml-60
            "
            v-if="items.length"
        >
            <ul class="bg-white w-fullrelative" ref="dropdown">
                <li class="mt-4" v-for="(item, index) in items" :key="item.id">
                    <a
                        class="
                            p-1
                            block
                            w-full
                            focus:ring-2
                            focus:bg-gray-300
                            focus:border-transparent
                            font-mono font-light
                            hover:bg-gray-300
                            cursor-pointer
                        "
                        href="#"
                        :class="{ 'bg-gray-300': index == focusedIndex }"
                        @keyup.exact.down="nextFocused"
                        @keyup.exact.up="previousFocused"
                        @click.prevent="selectedCategory(index)"
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
            type: Array,
        },
    },
    data() {
        return {
            items: [],
            term_search: "",
            category_id: null,
            selectedCategoryId: null,
            focusedIndex: 0,
        };
    },
    methods: {
        search() {
            if (this.term_search == "") {
                this.items = this.categories;
            } else {
                this.items = this.categories.filter((category) => {
                    if (
                        category.name
                            .toUpperCase()
                            .indexOf(this.term_search.toUpperCase()) != -1
                    )
                        return category;
                });
            }
        },
        selectedCategory(index, event) {
            if (this.items.length) {
                EventBus.$emit("selected-category", this.items[index].id);
                this.term_search = this.items[index].name.toUpperCase();
                this.items = [];
            }
        },
        close() {
            this.items = [];
            this.term_search = "";
        },
        nextFocused(event) {
            if (this.focusedIndex < this.items.length - 1) {
                this.focusedIndex = this.focusedIndex + 1;
                this.$refs.dropdown.children[
                    this.focusedIndex
                ].children[0].scrollIntoView({ block: "nearest" });
            }
        },
        previousFocused() {
            if (this.focusedIndex > 0) {
                this.focusedIndex = this.focusedIndex - 1;

                this.$refs.dropdown.children[
                    this.focusedIndex
                ].children[0].scrollIntoView({ block: "nearest" });
            }
        },
        allCategories(){
            if(this.term_search == ''){
                this.items = this.categories;
            }
        }
    },
};
</script>
