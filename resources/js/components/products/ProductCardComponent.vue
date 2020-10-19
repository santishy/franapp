<template>
    <div class=" rounded overflow-hidden shadow-lg bg-white">
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
                <a :href="`/products/${product.id}/edit`" class="bg-blue-500 inline-block cursor-pointer hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded">
                    <i class="far fa-edit"></i> Editar
                </a>
                <remove-product :product="product" :index="index"/>
            </div>
        </div>
    </div>
</template>
<script>
import RemoveProductComponent from './RemoveProductComponent.vue';
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
        'remove-product':RemoveProductComponent
    }
}
</script>