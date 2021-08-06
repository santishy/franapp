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
                            v-for="(inventory, index) in inventories"
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
        </information-component>
    </nav-component>
</template>

<script>
import NavComponent from "../NavComponent.vue";
import WarehouseListItem from "./WarehouseListItem.vue";
import Message from "../alerts/Message.vue";
import InformationComponent from "../modals/InformationComponent.vue";
export default {
    components: {
        NavComponent,
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
            title: "",
            msg: ""
        };
    }
};
</script>
