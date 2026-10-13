<template>
    <transition name="alert">
        <div
            v-if="show"
            class="w-full bg-red-50 border-l-4 border-red-500 text-red-700 px-4 py-3"
            role="alert"
        >
            <p class="font-bold">Se detecto los siguientes errores:</p>
            <ul>
                <li v-for="error in errorsFound" :key="error">
                    {{ error }}
                </li>
            </ul>
        </div>
    </transition>
</template>

<script>
export default {
    data() {
        return {
            show: false,
            timeoutId: null,
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
            handler() {
                if (this.errorsFound) {
                    clearTimeout(this.timeoutId);
                    this.show = true;
                    this.timeoutId = setTimeout(() => {
                        this.show = false;
                        EventBus.$emit("emptyErrors");
                        this.timeoutId = null;
                    }, 5000);
                }
            },
        },
    },
};
</script>
<style>
/*
 * Transición "alert": Vue agrega y quita estas clases solo,
 * nosotros únicamente describimos el inicio, el final y el "cómo".
 */

/* CÓMO se anima: qué propiedades, cuánto dura y con qué curva.
   Vue la mantiene puesta durante toda la animación. */
.alert-enter-active {
    transition:
        opacity 250ms ease-out,
        transform 250ms ease-out;
}

/* La salida un poco más rápida: al usuario le importa menos ver algo irse. */
.alert-leave-active {
    transition:
        opacity 150ms ease-in,
        transform 150ms ease-in;
}

/* DESDE dónde aparece (primer frame de la entrada)
   y HACIA dónde se va (último frame de la salida).
   Es el mismo estado: invisible y 8px más arriba. */
.alert-enter-from,
.alert-leave-to {
    opacity: 0;
    transform: translateY(-8px);
}

/* No hace falta .alert-enter-to ni .alert-leave-from:
   el estado "normal" del div (visible, en su sitio) ya es ese. */
</style>
