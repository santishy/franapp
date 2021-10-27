<template>
    <table class="table-auto text-center">
        <thead class="bg-purple-200">
            <tr >
                <th class="p-3">SKU</th>
                <th class="p-3">Descripción</th>
                <th class="p-3">Cantidad</th>
                <th class="p-3">Precio</th>
            </tr>
        </thead>
        <tbody>
            <tr 
                v-for="product in products"
                :key="product.id"
            >
                <td class="border px-4 py-2">{{product.sku}}</td>
                <td class="border px-4 py-2">{{product.description}}</td>
                <td class="border px-4 py-2">{{product[`${transactionType}_quantity`]}}</td>
                <td class="border px-4 py-2">{{product[`${transactionType}_price`]}}</td>
            </tr>
        </tbody>
        <!-- <infinite-loading
            :identifier="infiniteId"
            @infinite="getProducts"
            ref="infiniteLoading"
        ></infinite-loading> -->
    </table>
</template>
<script>
export default {
    props:{
        products:{
            type:Array
        },
        transactionType:{
            type:String
        }
    },
    data() {
        return {
            page:1
        }
    },
    methods:{
        // getProducts(){
        //     axios.get(`/}`)
        // }
    }
}
</script>