import { onBeforeUnmount, ref } from "vue";

export function useErrors() {
    const errors = ref(null);

    const emptyErrors = () => {
        errors.value = null;
    };

    EventBus.$on("emptyErrors", emptyErrors);

    onBeforeUnmount(() => {
        EventBus.$off("emptyErrors", emptyErrors);
    });
    const getErrors = (err) => {
        if (err?.response?.status === 403) {
            return (window.location.href = "/403");
        }
        errors.value = Object.values(err?.response?.data?.errors).flat();
    };

    return { errors, emptyErrors, getErrors };
}
