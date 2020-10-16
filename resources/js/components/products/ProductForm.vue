<template>
    <div class="w-full  flex justify-center mt-20 bg-transparent">
        <form @submit.prevent="submit" class="w-full max-w-md shadow-lg rounded-lg bg-white px-6 py-8">
            <div class="flex items-center py-2 text-dark text-center justify-center text-xl font-bold border-b border-teal-500">
                Añadir producto
            </div>
            <div class="flex items-center border-b border-teal-500 py-2">
                <input v-model="form.sku" name="sku" class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="SKU" aria-label="Full name">
            </div>
            <div class="flex items-center border-b border-teal-500 py-2">
                <textarea v-model="form.description" name="description" class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="DESCRIPCIÓN DEL PRODUCTO" aria-label="Full name">
                </textarea>
            </div>
            <div class="flex items-center border-b border-teal-500 py-2">
                <input v-model="form.wholesale_price" name="wholesale_price" class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="number" placeholder="PRECIO AL POR MAYOR" aria-label="Full name">
            </div>
            <div class="flex items-center border-b border-teal-500 py-2">
                <input v-model="form.retail_price" name="retail_price" class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="number" placeholder="PRECIO AL POR MENOR" aria-label="Full name">
            </div>
            <div class="flex items-center border-b border-teal-500 py-2">
                <input v-model="form.distributor_price" name="distributor_price" class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="number" placeholder="PRECIO DISTRIBUIDOR" aria-label="Full name">
            </div>
            <div v-if="errors"  class="flex items-center border-b border-teal-500 py-2">
                 <errors-component  :errors="errors" />
            </div>
           
            <div class="flex justify-center mt-0 mb-0">
                <button class="bg-transparent transition-all duration-500 ease-in-out hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border-b-2 border-blue-500 hover:border-transparent w-full">
                    Guardar
                </button>
            </div>
           <notifications group="foo"></notifications>
        </form>
    </div>
</template>

<script>
export default {
    data(){
        return{
            form:{},
            errors:null,
        }
    },
    mounted(){
     
    },
    props:{
        method:{
            type:String
        }
    },
    methods:{
        submit(){
            
            axios[this.method]('/products',this.form)
                .then((res) => {
                    this.$notify({
                        group: 'foo',
                        title: 'Productos',
                        text: 'El producto se creo correctamente'
                    });
                    this.form={};
                    this.errors=null;
                })
                .catch((err) => {
                    this.errors = Object.values(
                        err.response.data.errors
                    ).flat();
                })
        }
    }
}
</script>