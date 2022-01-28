<template>
    <tr
        class="
            bg-white
            border-b border-gray-400
            md:border-none
            block
            md:table-row
        "
    >
        <td
            class="
                p-2
                md:border md:border-grey-500
                text-left
                block
                md:table-cell
            "
        >
            <span class="inline-block w-1/3 md:hidden font-bold">Nombre</span
            >{{ inventory.name }}
        </td>
        <td
            class="
                p-2
                md:border md:border-grey-500
                text-left
                flex flex-wrap
                md:table-cell
            "
        >
            <span class="inline-block w-1/3 md:hidden font-bold">Dirección</span
            ><p class="inline-block w-2/3 sm:w-full">{{ inventory.address }}</p>
        </td>
        <td
            class="
                p-2
                md:border md:border-grey-500
                text-left
                flex
                items-center
                block
                md:table-cell
            "
        >
            <span class="inline-block w-1/3 md:hidden font-bold">Acciones</span>
            <div
                class="
                    flex flex-wrap sm:flex-row flex-col
                    justify-center
                    w-full
                    items-center
                    inline-block
                "
            >
                <link-edit-warehouse
                    :inventory="inventory"
                    class="mb-1 sm:mb-0 sm:w-auto w-full sm:mr-2"
                ></link-edit-warehouse>
                <empty-warehouse
                    class="mb-1 sm:mb-0 sm:w-auto w-full sm:mr-2"
                    :warehouse="inventory"
                    :index="index"
                ></empty-warehouse>
                <delete-warehouse
                    class="sm:w-auto w-full block"
                    :inventory="inventory"
                    :index="index"
                ></delete-warehouse>
            </div>
        </td>
    </tr>
</template>
<script>
import DeleteWarehouse from "./DeleteWarehouse.vue";
import EmptyWarehouse from "./EmptyWarehouse.vue";
import LinkEditWarehouse from "./LinkEditWarehouse.vue";
export default {
    props: {
        inventory: {
            type: Object,
        },
        index: {
            type: Number,
        },
    },
    components: {
        EmptyWarehouse,
        DeleteWarehouse,
        LinkEditWarehouse,
    },
};
</script>
