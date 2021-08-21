<template>
    <div
        class="flex justify-between items-center"
        @click="changeFilter"
    >
        <h2 class="text-red-500  font-semibold mr-3">Transacciones Canceladas</h2>
        <div
            class="w-16 h-10 flex items-center bg-gray-300 rounded-full p-1 duration-300 ease-in-out"
            :class="{ 'bg-green-400': toggleActive }"
        >
            <div
                class="bg-white w-8 h-8 rounded-full shadow-md transform duration-300 ease-in-out"
                :class="{ 'translate-x-6': toggleActive }"
            ></div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            toggleActive: false
        };
    },
    methods:{
        changeFilter(){
            this.toggleActive = !this.toggleActive;
            EventBus.$emit("status-filter-cancelled",'cancelled');
        }
    }
};
</script>
