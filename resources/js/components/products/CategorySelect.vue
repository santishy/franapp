<template>
    <div
        class="flex flex-col-reverse px-2 sm:px-0 sm:flex-row sm:items-center sm:border-b sm:border-t border-gray-300 relative"
    >
        <input
            v-model="term_search"
            ref="searchInput"
            :class="[inputClass]"
            class="appearance-none bg-gray-200 sm:bg-transparent p-2 sm:p-0 rounded-sm border-none w-full text-gray-700 mr-3 focus:outline-none placeholder-gray-600"
            autocomplete="off"
            @focus="allCategories"
            @keyup.prevent="search"
            @keyup.esc.prevent="close"
            @keyup.down.prevent="nextFocused"
            @keyup.up.prevent="previousFocused"
            @keyup.exact.enter.prevent="selectedCategory(focusedIndex, $event)"
            type="text"
            placeholder="Click o Enter para seleccionar | Presione la tecla ESC para limpiar"
            aria-label="Full name"
        />
        <slot name="labelCategory"> </slot>

        <button
            @click.prevent="close"
            class="absolute text-gray-700 border border-gray-400 font-semibold sm:right-0 px-3 sm:py-1 py-2 right-2 bg-white hover:bg-gray-300 rounded-sm shadow"
        >
            X
        </button>
        <div
            :class="listContainer"
            class="absolute sm:mt-0 top-10 mt-10 sm:w-10/12 w-10/12 shadow-lg z-5 rounded overflow-x-auto"
            v-if="items.length"
        >
            <ul
                class="bg-white border border-orange-300 w-full relative"
                ref="dropdown"
            >
                <li v-for="(item, index) in items" :key="item.id">
                    <a
                        class="pl-4 block w-full focus:ring-2 focus:bg-gray-300 focus:border-transparent font-mono font-light hover:bg-gray-300 cursor-pointer"
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
        product: {
            type: Object,
        },
        inputClass: { type: String },
        listContainer: {
            type: String,
            default: "",
        },
    },
    mounted() {
        if (this.product) {
            console.log(this.product.category_id);
            const category = this.categories.find(
                (ele) => ele.id == this.product.category_id
            );
            console.log(category);
            this.term_search = category.name;
        }
        EventBus.$on("clean-search-term", () => {
            this.term_search = "";
        });
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
        search(event) {
            if (event.key === "ArrowDown" || event.key === "ArrowUp") return;
            this.focusedIndex = 0;
            if (this.term_search == "") {
                this.items = this.categories;
            } else {
                this.items = this.categories.filter((category) => {
                    //var re = this.term_search.replace(/\s/g, '|'); idea nada mas,
                    //podria parter la cadena completa en dos partes mitad|mitad y buscar

                    if (
                        category.name.search(
                            new RegExp(this.term_search, "i")
                        ) != -1
                        //.search(new RegExp(re,'i')) != -1
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
        focus(){
            $this.$refs.searchInput.focus();
        },
        close() {
            EventBus.$emit("selected-category", null);
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
        allCategories() {
            if (this.term_search == "") {
                this.items = this.categories;
            }
        },
    },
};
</script>
