<template>
    <tr class="border-b text-center">
        <td class="flex flex-wrap justify-center items-center">
            <div class=" image-container ">
                <img
                    :src="product.image_url"
                    loading="lazy"
                    alt="product.sku"
                    class="object-contain md:object-fill"
                />
            </div>
        </td>
        <td>
            {{ product.sku }}
        </td>
        <td>
            {{ product.category_name }}
        </td>
        <td>
            {{ product.description }}
        </td>
        <td>
            {{ product.formatted_wholesale_price }}
        </td>
        <td>
            {{ product.formatted_retail_price }}
        </td>
        <td>
            {{ product.formatted_distributor_price }}
        </td>
        <td>
            
        </td>
    </tr>
</template>
<script>
export default {
    props: {
        product: {
            type: Object,
        },
        index: {
            type: Number,
        },
    },
};
</script>
<style lang="css">
    .image-container{
        width: 100px;
    }
</style>