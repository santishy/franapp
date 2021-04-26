<template>
    <table v-if="products.length" class="table-auto text-center bg-white" >
        <thead class="bg-purple-200">
            <th class="p-3">SKU</th>
            <th class="p-3">Descripción</th>
            <th class="p-3">Existencias</th>
            <th class="p-3">Acciones</th>
        </thead>
        <transition-group name="bounce" tag="tbody">
            <tr v-for="product in products" :key="product.id">
                <td class="border px-4 py-2">{{product.sku}}</td>
                <td class="border px-4 py-2">{{product.description}}</td>
                <td class="border px-4 py-2">{{product.stock}}</td>
                <td class="border px-4 py-2"></td>
            </tr>
        </transition-group>
    </table>
</template>
<script>
export default {
    data(){
        return {
            products:[],
            inventory:null
        }
    },
    mounted(){
        EventBus.$on('selected-inventory',(inventory) => {
            this.inventory = inventory;
            this.getProducts()
        });
    },
    methods:{
        getProducts(){
            axios.get(`/inventories/${this.inventory.id}`,{
                params:{
                    'include':'products' 
                }
            })
            .then( res => {
                this.products = []
                this.products = res.data.data.products;
            })
            .catch( err => {
                console.log(err)
            })
        }
    }
}
</script>