<template>
    <tr class="bg-slate-100  ">
        <td class="p-2 w-16">
            <img class="w-100" :src="(product && product.image_url) || ''" :alt="(product && product.sku) || ''" />
        </td>
        <td class="p-2 text-slate-700 font-mono">
            {{ product.sku }}
        </td>
        <td class="p-2">
            {{ product.description }}
        </td>
        <td class="p-2">
            <editable-product-quantity v-if="saleStatus === 'pending'" :product="product"></editable-product-quantity>
            <span v-else>
                {{ product.sale_quantity }}
            </span>

        </td>
        <td class="p-2">
            <editable-product-price v-if="saleStatus === 'pending'" :product="product"></editable-product-price>
            <span v-else>
                {{ product.sale_price }}
            </span>
        </td>
        <td class="p-2">
            {{ product.sale_price * product.sale_quantity }}
        </td>
        <td class="p-2 ">
            <div class="flex justify-center items-center">
                <delete-sale-product v-if="saleStatus === 'pending'" :id="product.id"
                    :index="index"></delete-sale-product>
                <NoSymbol class="w-5 h-5 text-gray-500" v-else />
            </div>
        </td>
    </tr>
</template>

<script>
import DeleteSaleProduct from "./DeleteSaleProduct.vue";
import EditableProductQuantity from "./partials/EditableProductQuantity.vue";
import EditableProductPrice from "./partials/EditableProductPrice.vue";
import { mapState } from "vuex";
import NoSymbol from "../icons/NoSymbol.vue";
import EditIcon from "../icons/EditIcon.vue";
export default {
    props: {
        product: {
            type: Object,
            required: true,
        },
        index: {
            type: Number,
        },
        saleStatus: {
            type: String,
        },
    },
    components: { DeleteSaleProduct, EditIcon, EditableProductQuantity, EditableProductPrice, NoSymbol },
    data() {
        return {
            form: {},
        };
    },
    created() {
        this.form.qty = this.product.sale_quantity;
        this.form.sale_price = this.product.sale_price;
    },
    methods: {
        submit() {
            this.form._method = "put";
            this.form.product_id = this.product.id;
            if (this.isAdmin)
                this.form.inventory_id = sessionStorage.getItem("inventory_id");
            else {
                thi.form.inventory_id = this.user.inventory_id;
            }
            axios
                .post(`/sales/${this.product.id}/products`, this.form)
                .then((res) => {
                    EventBus.$emit("updated-sales-product", {
                        index: this.index,
                        transaction: res.data,
                    });
                })
                .catch((err) => {
                    console.log(err);
                });
        },
    },
    computed: {
        ...mapState(["salePriceOption"]),
    },
};
</script>
