<template>
    <div
        class="flex justify-between items-center rounded border-2 border-gray-200 px-2 py-1 cursor-pointer "
        @click="changeFilter"
    >
        <h2 class="text-red-700  font-extralight text-sm mr-3">Notas Canceladas</h2>
        <div
            class="w-12 h-8 flex items-center bg-gray-200 rounded-full  duration-300 ease-in-out border border-red-500"
            :class="{ 'bg-green-400': toggleActive }"
        >
            <div
                class="bg-white w-6 h-6 rounded-full shadow-md transform duration-300 ease-in-out border border-red-500"
                :class="{ 'translate-x-4': toggleActive }"
            ></div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            toggleActive: false,
            status:''
        };
    },
    methods:{
        changeFilter(){
            this.toggleActive = !this.toggleActive;
            this.status = this.toggleActive ? 'cancelled' : 'completed'
            EventBus.$emit("status-filter-cancelled",this.status);
        }
    }
};
</script>
