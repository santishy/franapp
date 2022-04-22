<template>
    <button
        @click="openAlert"
        v-can="'delete product'"
        class="
            rounded-full
            hover:text-gray-800
            shadow-xs
            text-gray-600
            font-bold
            py-2
            bg-white
            px-2
            text-2xl
        "
    >
        <trash-icon></trash-icon>
    </button>
</template>
<script>
import { mapMutations } from "vuex";
import TrashIcon from "../icons/TrashIcon.vue";
export default {
    components: { TrashIcon },
    props: {
        product: {
            type: Object,
        },
        index: {
            type: Number,
        },
    },
    methods: {
        ...mapMutations(["setModalDataConfirm"]),
        openAlert() {
            this.setModalDataConfirm({
                product: this.product,
                index: this.index,
                message:
                    "Si eliminas este producto, no se podran revertir los cambios en la base de datos.",
                title: "¿Estas seguro de eliminar el producto?",
                action: "deleteProduct",
            });
            EventBus.$emit("open-modal", true);
        },
    },
};
</script>
