<template>
    <!-- This example requires Tailwind CSS v2.0+ -->
    <transition
        enter-active-class="ease-out duration-300"
        enter-class="opacity-0"
        enter-to-class="opacity-100"
        leave-active-class="ease-in duration-200"
        leave-class="opacity-100"
        leave-to-class="opacity-0"
    >
        <div
            class="fixed z-10 inset-0 overflow-y-auto"
            aria-labelledby="modal-title"
            role="dialog"
            aria-modal="true"
            v-show="modal"
        >
            <div
                class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0"
            >
                <!--
                Background overlay, show/hide based on modal state.

                Entering: "ease-out duration-300"
                    From: "opacity-0"
                    To: "opacity-100"
                Leaving: "ease-in duration-200"
                    From: "opacity-100"
                    To: "opacity-0"
            -->
                <div
                    class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                    aria-hidden="true"
                ></div>

                <!-- This element is to trick the browser into centering the modal contents. -->
                <span
                    class="hidden sm:inline-block sm:align-middle sm:h-screen"
                    aria-hidden="true"
                    >&#8203;</span
                >

                <!--
            Modal panel, show/hide based on modal state.

            Entering: "ease-out duration-300"
                From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                To: "opacity-100 translate-y-0 sm:scale-100"
            Leaving: "ease-in duration-200"
                From: "opacity-100 translate-y-0 sm:scale-100"
                To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            -->
                <transition
                    enter-active-class="ease-out duration-300"
                    enter-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    enter-to-class="opacity-100 translate-y-0 sm:scale-100"
                    leave-class="ease-in duration-200"
                    leave-active-class="opacity-100 translate-y-0 sm:scale-100"
                    leave-to-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                >
                    <!-- Se usa v-show aki y arriba para que funcione la transicion -->
                    <div
                        v-show="modal"
                        class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                    >
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <!-- <div
                                    class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-blue-100 sm:mx-0 sm:h-10 sm:w-10"
                                >
                                    
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-6 w-6"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                        />
                                    </svg>
                                </div> -->
                                <div
                                    class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left"
                                >
                                    <h3
                                        class="text-lg leading-6 font-medium text-gray-900"
                                        id="modal-title"
                                    >
                                        <slot name="title"></slot>
                                    </h3>
                                    <div class="mt-2">
                                        <slot></slot>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div
                            class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse"
                        >
                            <slot name="button"></slot>
                            <button
                                type="button"
                                @click="modal = false"
                                class="mt-3 w-full inline-flex justify-center rounded-md  border-2 shadow-sm px-4 py-3 mr-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm border-gray-400"
                            >
                                Cerrar
                            </button>
                        </div>
                    </div>
                </transition>
            </div>
        </div>
    </transition>
</template>
<script>
export default {
    props: {
        id: {
            type: Number
        }
    },
    data() {
        return {
            modal: false
        };
    },
    created() {
        if (this.id) {
            EventBus.$on("open-modal-"+this.id, value => {
                this.modal = value;
            });
        } else {
            EventBus.$on("open-modal", value => {
                this.modal = value;
            });
        }
    }
};
</script>
