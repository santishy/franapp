<template>
    <div class="w-full">
        <nav
            class="
                flex
                
                items-center
                justify-between
                flex-wrap
                rounded-b-sm
                bg-white
                shadow-sm
                p-4
                sm:mx-4 sm:right-0 sm:left-64
                fixed
                w-full
                sm:h-auto
              
                max-h-screen
                sm:w-auto
                top-0
                z-10
            "
        >
            <div class="flex items-center flex-shrink-0 text-gray-800 mr-6">
                <span class="font-semibold text-xl tracking-tight md:hidden"
                    >ISCO</span
                >
            </div>
            <div @click="toggleNavegation" class="block sm:hidden ">
                <button
                    class="
                        flex
                        items-center
                        px-3
                        py-2
                        border
                        rounded
                        text-teal-200
                        border-teal-400
                        hover:text-white hover:border-white
                    "
                >
                    <svg
                        class="fill-current h-3 w-3"
                        viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <title>Menu</title>
                        <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
                    </svg>
                </button>
            </div>
            <div
                id="navegation"
                class="w-full block hidden  flex-grow md:flex md:items-center md:w-auto max-h-screen h-screen sm:h-auto sm:overflow-y-hidden overflow-y-scroll"
            >
                <div
                    class="
                        text-sm
                        md:flex-grow
                        flex flex-wrap
                        flex-col
                        
                        md:flex-row
                        md:justify-center
                    "
                >
                    <dropdown-component
                        name="Inventario"
                        :items="InventoryMenu"
                        class="md:relative md:hidden"
                    />
                    <a
                        v-if="purchase"
                        :href="purchase ? `/purchases/${purchase}` : '#'"
                        :class="highlight"
                        class="
                            block
                            mt-4
                            lg:inline-block lg:mt-0
                            md:hover:text-white
                            mr-4
                        "
                    >
                        Realizar Compra
                    </a>
                    <dropdown-component
                        name="Clientes"
                        :items="clientsMenu"
                        class="md:relative md:hidden"
                    />
                    <a
                        href="/sales/create"
                        class="
                            block
                            mt-4
                            lg:inline-block lg:mt-0
                            text-blue-700
                            sm:hover:text-blue-800
                            mr-4
                            md:text-base
                            text-lg
                        "
                    >
                        <div
                            class="
                                flex flex-wrap
                                sm:items-center
                                sm:justify-center
                                font-mono
                            "
                        >
                            <shopping-bag></shopping-bag>
                            <span
                                class="self-end leading-none font-xl font-bold"
                                >Ventas</span
                            >
                        </div>
                    </a>
                    <dropdown-component
                        name="Reportes"
                        :items="ReportsMenu"
                        class="md:relative md:hidden"
                    />
                    <dropdown-component
                        name="Configuración"
                        :items="ConfigMenu"
                        class="md:relative lg:hidden"
                    />
                </div>
                <div class="flex flex-wrap items-center">
                    <form
                        v-if="impersonation_id"
                        action="/impersonations"
                        method="post"
                        class="
                            block
                            mt-4
                            lg:inline-block lg:mt-0
                            md:hover:text-white
                            mr-4
                        "
                    >
                        <input type="hidden" name="_method" value="delete" />
                        <input type="hidden" name="_token" :value="crfsToken" />
                        <button
                            class="
                                text-gray-300
                                border-red-900 border
                                rounded
                                px-2
                                py-1
                            "
                        >
                            Regresar <i class="fas fa-user"></i>
                        </button>
                    </form>
                    <form action="/logout" method="POST">
                        <input type="hidden" name="_token" :value="crfsToken" />
                        <button
                            href="/logout"
                            class="
                                inline-block
                                text-sm
                                px-4
                                py-2
                                leading-none
                                border
                                bg-white
                                rounded
                                text-gray-800
                                border-teal-300
                                hover:border-transparent
                                md:hover:text-teal-500 md:hover:bg-white
                                mt-4
                                lg:mt-0
                            "
                        >
                            {{ getCurrentUser.name }} | Salir
                        </button>
                    </form>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main class="mt-20 w-ful z-0 flex flex-wrap">
            <sidebar>
                <accordion :items-menu="InventoryMenu" name="Inventario">
                    <template slot="descriptive-icon">
                        <boxes
                            class="mr-2 h-8 w-8 p-1 text-gray-700 rounded-sm"
                        ></boxes>
                    </template>
                    <template slot="icon">
                        <down-arrow class="text-xs"></down-arrow>
                    </template>
                </accordion>
                <accordion :items-menu="clientsMenu" name="Clientes">
                    <template slot="descriptive-icon">
                        <users-icon
                            class="mr-2 h-7 w-7 p-1 text-gray-700 rounded-sm"
                        ></users-icon>
                    </template>
                    <template slot="icon">
                        <down-arrow class="text-xs"></down-arrow>
                    </template>
                </accordion>
                <accordion :items-menu="ReportsMenu" name="Reportes">
                    <template slot="descriptive-icon">
                        <bars-icon
                            class="mr-2 h-7 w-7 p-1 text-gray-700 rounded-sm"
                        ></bars-icon>
                    </template>
                    <template slot="icon">
                        <down-arrow class="text-xs"></down-arrow>
                    </template>
                </accordion>
                <accordion :items-menu="ConfigMenu" name="Configuración">
                    <template slot="descriptive-icon">
                        <setting-icon
                            class="mr-2 h-7 w-7 p-1 text-gray-700 rounded-sm"
                        ></setting-icon>
                    </template>
                    <template slot="icon">
                        <down-arrow class="text-xs"></down-arrow>
                    </template>
                </accordion>
            </sidebar>
            <div class="flex-1 sm:ml-64">
                <slot class="bg-blue-500" />
            </div>
        </main>
        <notifications group="foo"></notifications>
    </div>
</template>
<script>
import Sidebar from "./menu/Sidebar.vue";
import Accordion from "./menu/Accordion.vue";
import WarehouseIcon from "./icons/WarehouseIcon";
import ShoppingBag from "./icons/ShoppingBag.vue";
import Boxes from "./icons/Boxes.vue";
import UsersIcon from "./icons/UsersIcon.vue";
import DownArrow from "./icons/DownArrow.vue";
import BarsIcon from "./icons/BarsIcon.vue";
import SettingIcon from "./icons/SettingIcon.vue";

export default {
    components: {
        SettingIcon,
        BarsIcon,
        UsersIcon,
        Boxes,
        Sidebar,
        Accordion,
        WarehouseIcon,
        ShoppingBag,
        DownArrow,
    },
    data() {
        return {
            clientsMenu: [
                {
                    name: "Nuevo cliente",
                    url: "/clients/create",
                },
                {
                    name: "Catalago clientes",
                    url: "/clients",
                },
            ],
            InventoryMenu: [
                {
                    name: "Nuevo inventario",
                    url: "/inventories/create",
                },
                {
                    name: "Catalago almacenes",
                    url: "/warehouses",
                },
                {
                    name: "Existencias",
                    url: "/inventories",
                },
                {
                    name: "Nueva categoría",
                    url: "/categories",
                },
                {
                    name: "Nuevo producto",
                    url: "/products/create",
                },
                {
                    name: "Comprar productos",
                    url: "/products",
                },
            ],
            ReportsMenu: [
                {
                    name: "Ventas",
                    url: "/sales/",
                },
                {
                    name: "Compras",
                    url: "/purchases",
                },
            ],
            ConfigMenu: [
                {
                    name: "Nuevo usuario",
                    url: "/register/",
                },
                {
                    name: "Modificar usuario",
                    url: "/users",
                },
                {
                    name: "Nuevo rol",
                    url: "/roles/create",
                },
                {
                    name: "Contenido del ticket",
                    url: "/tickets/1/edit",
                },
            ],
            crfsToken: document.querySelector('meta[name="csrf-token"]')
                .content,
            purchase: false,
            impersonation_id: document.querySelector(
                'meta[name="impersonation_id"]'
            ).content,
        };
    },
    created() {
        this.cleanLocalStorage();
    },
    mounted() {
        this.purchase = document.head.querySelector(
            'meta[name="purchase_id"]'
        ).content;
        EventBus.$on("purchase-created", this.setPurchaseId);
        this.cleanLocalStorage();
    },
    methods: {
        toggleNavegation() {
            document.querySelector("#navegation").classList.toggle("hidden");
        },
        setPurchaseId(id) {
            this.purchase = id;
        },
        cleanLocalStorage() {
            if (
                document.head.querySelector('meta[name="purchase_id"]')
                    .content == "" ||
                document.head.querySelector('meta[name="purchase_id"]')
                    .content == null
            )
                localStorage.removeItem("productsInPurchase");
        },
    },
    computed: {
        highlight() {
            return this.purchase
                ? "text-lg text-black-700 border-teal-300 border-b-2"
                : "text-gray-200";
        },
    },
};
</script>
