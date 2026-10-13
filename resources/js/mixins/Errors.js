export default {
    data: () => {
        return {
            errors: null,
        };
    },
    created() {
        EventBus.$on("emptyErrors", this.emptyErrors);
    },
    beforeUnmount() {
        EventBus.$off("emptyErrors", this.emptyErrors);
    },
    methods: {
        emptyErrors() {
            this.errors = null;
        },
        getErrors(err) {
            if (err?.response?.status === 403) {
                return (window.location.href = "/403");
            }
            this.errors = Object.values(err?.response?.data?.errors).flat();
        },
    },
};
