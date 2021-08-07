<template>
    <form @submit.prevent="openModal">
        <button
            class="text-xs transition-all rounded border-2 border-red-800 text-red-700 p-1 hover:bg-red-800 hover:text-white"
            type="submit"
        >
            <i class="fas fa-trash"></i> Eliminar almacen
        </button>
    </form>
</template>
<script>
import { mapMutations } from "vuex";
export default {
    props: {
        inventory: {
            type: Object
        },
        index: {
            type: Number
        }
    },
    methods: {
        ...mapMutations(["setModalDataConfirm"]),
        openModal() {
            this.setModalDataConfirm({
                inventory: this.inventory,
                index: this.index
            });
            EventBus.$emit("open-modal", true);
        }
    }
};
</script>
