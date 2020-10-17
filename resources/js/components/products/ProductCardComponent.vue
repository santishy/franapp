<template>
    <div class=" rounded overflow-hidden shadow-lg">
        <div class="text-center">
            <div class="font-bold text-xl mb-2  p-4 border-b-2 border-teal-400">{{product.sku}}</div>
            <p class="text-gray-700 text-base  p-4 border-b-2 border-teal-400">
                {{product.description}}
            </p>
            <p class="text-gray-700 text-base border-b-2 p-4 border-teal-400">
                {{product.formatted_wholesale_price}}
            </p>
            <p class="text-gray-700 text-base border-b-2 p-4 border-teal-400">
                {{product.formatted_retail_price}}
            </p>
            <p class="text-gray-700 text-base border-b-2 p-4 border-teal-400">
                {{product.formatted_distributor_price}}
            </p>
            <div class="px-6 pt-4 pb-2">
                <button class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded">
                    Editar
                </button>
                <button class="bg-red-500 hover:bg-red-400 text-white font-bold py-2 px-4 border-b-4 border-red-700 hover:border-red-500 rounded">
                    Eliminar
                </button>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props:{
        product:{
            type:Object
        }
    }
}
</script>