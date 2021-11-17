<template>
    <div class="w-64 flex flex-col  bg-white shadow-sm p-2">
        <div class="flex flex-wrap">
            <p class="text-xs font-mono">Compras:</p>
            <span
                :class="[getTextColor]"
                class="font-semibold text-xs ml-2 font-mono"
            >
                {{ getTitle }}
            </span>
        </div>
        <div class="flex flex-wrap mt-4">
            <button
                @click="togglePurchaseVisibility(true)"
                class="mr-2 text-green-700"
            >
                <div class="flex flex-wrap">
                    <check-circle></check-circle>
                    <span class="text-xs ml-1">Activar</span>
                </div>
            </button>
            <button
                @click="togglePurchaseVisibility(false)"
                class="text-orange-700"
            >
                <div class="flex flex-wrap">
                    <times-circle />
                    <span class="text-xs ml-1"> Desactivar </span>
                </div>
            </button>
        </div>
    </div>
</template>

<script>
import CheckCircle from "../icons/CheckCircle.vue";
import TimesCircle from "../icons/TimesCircle.vue";
export default {
    components: {
        CheckCircle,
        TimesCircle
    },
    props: {
        visibility: {
            type: Boolean
        }
    },
    methods: {
        togglePurchaseVisibility(bool) {
            window.localStorage.setItem("allow-to-buy-new-product", bool);
            EventBus.$emit("toggle-purchase-visibility", bool);
        }
    },
    computed: {
        getTitle() {
            return this.visibility ? "Activa" : "Desactivada";
        },
        getTextColor() {
            return this.visibility ? "text-green-700" : "text-red-700";
        }
    }
};
</script>
