<template>
    <div>
        <button @click="toggleModal = !toggleModal">
            <i class="far fa-window-maximize"></i>
        </button>
        <div v-if="toggleModal" class="fixed overflow-x-hidden overflow-y-auto inset-0 flex justify-center items-center z-50">
            <div class="relative mx-auto w-auto max-w-2xl">
                <div class="bg-white w-full">
                    hola mundo
                </div>
            </div>
        </div>
        <div
            v-if="toggleModal" 
            class="absolute inset-0 opacity-25 bg-black z-40"
        >
        </div>
    </div>
</template>
<script>
export default {
    data:()=>{
        return {
            toggleModal:false
        }
    }
};
</script>
