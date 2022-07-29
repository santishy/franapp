<template>
    <tr class="border-b text-center">
        <td class="flex flex-wrap justify-center items-center">
            <div class="image-container">
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
            <div class="flex flex-wrap justify-center items-center">
                <add-to-purchase
                    v-show="
                        visibleActions.purchase.toUpperCase() ===
                        queryType.toUpperCase()
                    "
                    :product_id="product.id"
                    :purchase_price="product.distributor_price"
                >
                </add-to-purchase>
                <add-to-sale
                    v-show="
                        visibleActions.sale.toUpperCase() ===
                        queryType.toUpperCase()
                    "
                    :index="index"
                    :product="product"
                >
                </add-to-sale>
                <edit-product
                    v-show="
                        visibleActions.edit.toUpperCase() ===
                        queryType.toUpperCase()
                    "
                    :product="product"
                ></edit-product>
                <remove-product-component
                    v-show="
                        visibleActions.delete.toUpperCase() ===
                        queryType.toUpperCase()
                    "
                    :product="product"
                    :index="index"
                ></remove-product-component>
            </div>
        </td>
    </tr>
</template>
<script>
import AddToPurchase from "../purchases/AddToPurchase.vue";
import AddToSale from "../sales/AddToSale.vue";
import EditProduct from "./EditProduct.vue";
import RemoveProductComponent from "./RemoveProductComponent.vue";
import { mapState } from "vuex";
export default {
    props: {
        product: {
            type: Object,
        },
        index: {
            type: Number,
        },
    },
    components: {
        AddToPurchase,
        AddToSale,
        EditProduct,
        RemoveProductComponent,
    },
    data() {
        return {
            visibleActions: {
                purchase: "toBuy",
                sale: "sell",
                edit: "list",
                delete: "list",
            },
        };
    },
    computed: {
        ...mapState(["queryType"]),
    },
};
</script>
<style lang="css">
.image-container {
    width: 100px;
}
</style>
