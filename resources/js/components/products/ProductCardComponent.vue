<template>
    <div class=" rounded overflow-hidden shadow-lg bg-white">
        <div class="text-justify">
            <div class="px-6 pt-4 pb-2 text-center flex justify-between">
                <add-to-purchase :product_id="product.id"/>
                <a :href="`/products/${product.id}/edit`" class="bg-blue-500 inline-block cursor-pointer hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded">
                    <i class="far fa-edit"></i> Editar
                </a>
                <remove-product :product="product" :index="index"/>
            </div>
            <div class=" p-4 border-b-2 border-teal-400">
                <p class="text-gray-800 font-bold mb-1">SKU</p>
                <p class="text-gray-700 text-base ">
                    {{product.sku}}
                </p>
            </div>
            <div class=" p-4 border-b-2 border-teal-400">
                <p class="text-gray-800 font-bold mb-1">Descripción</p>
                <p class="text-gray-700 text-base ">
                    {{product.description}}
                </p>
            </div>
            <div class=" p-4 border-b-2 border-teal-400">
                <p class="text-gray-800 font-bold mb-1">Precio al por mayor</p>
                <p class="text-gray-700 text-base ">
                    {{product.formatted_wholesale_price}}
                </p>
            </div>
            <div class=" p-4 border-b-2 border-teal-400">
                <p class="text-gray-800 font-bold mb-1">Precio al por menor</p>
                <p class="text-gray-700 text-base ">
                    {{product.formatted_retail_price}}
                </p>
            </div>
            <div class=" p-4 border-b-2 border-teal-400">
                <p class="text-gray-800 font-bold mb-1">Precio al por mayor</p>
                <p class="text-gray-700 text-base ">
                    {{product.formatted_distributor_price}}
                </p>
            </div>
            
        </div>
    </div>
</template>
<script>
import RemoveProductComponent from './RemoveProductComponent.vue';
import AddToPurchase from '../purchases/AddToPurchase.vue'
export default {
    props:{
        product:{
            type:Object
        },
        index:{
            type:Number
        }
    },
    components:{
        'remove-product':RemoveProductComponent,
        'add-to-purchase':AddToPurchase,
    }
}
</script>