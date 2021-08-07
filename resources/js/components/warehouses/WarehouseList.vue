<template>
    <nav-component>
        <div class="w-full flex justify-center ">
            <div
                class="bg-white shadow rounded max-w-full sm:overflow-x-hidden overflow-x-auto"
            >
                <table
                    v-if="inventories.length"
                    v-can="'view inventories'"
                    class="table-auto"
                >
                    <thead>
                        <tr class="bg-danger">
                            <th class="px-4 py-2">Nombre</th>
                            <th class="px-4 py-2">Dirección</th>
                            <th class="px-4 py-2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <warehouse-list-item
                            v-for="(inventory, index) in localInventories"
                            :key="inventory.id"
                            :inventory="inventory"
                            :index="index"
                        />
                    </tbody>
                </table>
            </div>
        </div>
        <information-component>
            <template slot="title">
                Inventario (almacén)
            </template>

            <message :title="title" :message="msg"></message>
            <template slot="button">
                <agree
                    method="deleteWarehouse"
                    @deleteWarehouse="deleteWarehouse"
                ></agree>
            </template>
        </information-component>
    </nav-component>
</template>

<script>
import { mapState, mapMutations} from "vuex";
import Agree from "../alerts/Agree.vue";
import Message from "../alerts/Message.vue";
import NavComponent from "../NavComponent.vue";
import WarehouseListItem from "./WarehouseListItem.vue";
import InformationComponent from "../modals/InformationComponent.vue";

export default {
    components: {
        NavComponent,
        Agree,
        WarehouseListItem,
        InformationComponent,
        Message
    },
    props: {
        inventories: {
            type: Array
        }
    },
    data() {
        return {
            title: "¿Estas seguro de eliminar el inventario?",
            msg: "",
            localInventories: []
        };
    },
    created() {
        if (this.inventories) this.localInventories = this.inventories;
    },
    methods: {
        ...mapMutations(['setModalDataConfirm']),
        deleteWarehouse() {
            if (this.modalDataConfirm)
                axios
                    .delete("/warehouses/" + this.modalDataConfirm.inventory.id)
                    .then(res => {
                        if (res.data.deleted) {
                            console.log(this.modalDataConfirm.index);
                            this.localInventories.splice(
                                this.modalDataConfirm.index,
                                1
                            );
                        }
                        this.setModalDataConfirm(null);
                        EventBus.$emit('open-modal',false);
                    });
        }
    },
    computed: {
        ...mapState(["modalDataConfirm"])
    }
};
</script>
