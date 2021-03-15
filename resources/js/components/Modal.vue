<template>
    <div>
        <button @click="toggleModal = !toggleModal">
            <i class="far fa-window-maximize"></i>
        </button>
        <div
            v-if="toggleModal"
            class="fixed modal  overflow-x-hidden overflow-y-auto  flex justify-center items-center z-50"
        >
            <div class="relative mx-auto max-w-6xl w-full border border-red-600">
                <div class="bg-white w-full rounded shadow-2xl p-4 relative">
                  
                </div>
            </div>
        </div>

        <div
            v-if="toggleModal"
            @click="toggleModal = false"
            class="fixed inset-0 opacity-25 bg-black z-40"
        ></div>
    </div>
</template>
<script>
export default {
    data: () => {
        return {
            toggleModal: false
        };
    }
};
</script>
<style scoped>
    .modal{
        top:50%;
        left:50%;
        transform:translate(-50%,-50%);
    }
</style>