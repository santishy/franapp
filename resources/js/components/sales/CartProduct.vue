<template>
    <div class="mt-2">
        <p class="text-gray-700 mb-2">{{ product.description }}</p>
        <input
            v-model="form.qty"
            name="qty"
            class="appearance-none bg-transparent border-gray-600 border-2 rounded-sm w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
            type="number"
            placeholder="Cantidad de venta"
            aria-label="Full name"
        />
    </div>
</template>

<script>
export default {
    props:{
        product:{
            type:Object,
            required:true
        }
    },
    data(){
        return {
            form:{}
        }
    },
    created(){
        this.form.qty = this.product.sale_quantity
    }
}
</script>
