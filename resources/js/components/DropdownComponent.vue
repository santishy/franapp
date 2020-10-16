<template>
    <a href="#responsive-header" class="block  mt-0 transition-all duration-500 ease-in-out mt-4 lg:inline-block lg:mt-0 text-gray-200 hover:text-white mr-4">
        <div @click="isOpen = !isOpen">Productos</div>
        <div v-if="isOpen" class="bg-transparent w-full md:bg-white static md:w-48 rounded-md md:absolute md:shadow-md md:mt-3 ">
        <a href="" class="pl-1 text-white block md:text-gray-800 md:p-2">Añadir</a>
        <a href="" class="pl-1 text-white block md:text-gray-800 md:p-2">Listar</a>
        </div>
    </a>
</template>
<script>
export default {
     data(){
      return{
        isOpen:false,
      }
    },
    created(){
      const handleEscape = (e) => {
        if(e.key == 'Esc' || e.key == 'Escape'){
          this.isOpen = false;
        }
      }

      document.addEventListener('keydown',handleEscape);

      this.$once('hook:beforeDestroy',()=>{
        document.removeEventListener('keydown',handleEscape);
      })
    },
}
</script>