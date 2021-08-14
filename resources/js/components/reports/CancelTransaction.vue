<template>
    <form @submit.prevent="submit">
        <button
            type="submit"
            class="transition-all text-xs rounded border-2 border-red-800 px-2 text-red-700 hover:bg-red-800 hover:text-white"
        >
            <i class="fas fa-ban"></i> Cancelar
        </button>
    </form>
</template>
<script>
import { mapMutations } from "vuex";
export default {
    props: {
        uri: {
            type: String
        },
        index:{
            type: Number
        },
        transaction: { type: Object }
    },
    methods: {
        ...mapMutations(["setModalDataConfirm"]),
        submit() {
            this.setModalDataConfirm({
                transaction: this.transaction,
                index: this.index,
                message: `Si cancelas esta ${this.transaction.transactionType} se revertira lo cambios en el inventario que se hicieron y no se podra deshacer la acción.`,
                title: `¿Estas seguro de eliminar esta ${this.transaction.transactionType}?`,
                action: "cancelTransaction"
            });
            EventBus.$emit("open-modal", true);
        },

    }
};
</script>
