<template>
    <div class="w-full flex flex-col">
        <nav class="
                flex
                h-16
                max-h-16
                overflow-y-hidden
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
                sm:w-auto
                top-0
                z-10
            ">
            <div class="flex items-center flex-shrink-0  mr-6">
                <span class="font-semibold text-xl tracking-tight md:hidden text-primary">ISCO</span>
            </div>
            <div class="block sm:hidden">
                <button @click="toggleNavigation" class="
                        flex
                        items-center
                        px-3
                        py-2
                        border
                        rounded
                        text-black
                        border-teal-400
                    ">
                    <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <title>Menu</title>
                        <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
                    </svg>
                </button>
            </div>

            <div id="navigation" class="
                    w-full
                    h-0
                    flex-grow
                    md:flex md:items-center md:w-auto
                    max-h-screen
                    sm:h-auto sm:overflow-y-hidden
                    overflow-y-hidden
                    transition-[height]
                    duration-700
                    ease-in-out
                ">
                <div class="
                        text-sm
                        md:flex-grow
                        flex flex-wrap flex-col
                        md:flex-row md:justify-center
                    ">
                    <dropdown-component name="Inventario" :items="InventoryMenu" class="md:relative md:hidden" />
                    <a v-if="purchase" :href="purchase ? `/purchases/${purchase}` : '#'" :class="highlight" class="
                            block
                            mt-4
                            lg:inline-block lg:mt-0

                            mr-4
                        ">
                        Lista de compras
                    </a>
                    <!-- <dropdown-component name="Clientes" :items="clientsMenu" class="md:relative md:hidden" /> -->
                    <a href="/sales/create/?queryType=sell" class="
                            sm:block
                            hidden
                            mt-4
                            lg:inline-block lg:mt-0
                            text-secondary
                            sm:hover:text-primary
                            mr-4
                            md:text-base
                            text-lg
                        ">
                        <div class="
                                flex flex-wrap
                                sm:items-center sm:justify-center
                                font-mono
                            ">
                            <shopping-bag></shopping-bag>
                            <span class="self-end leading-none font-xl font-bold">Ventas</span>
                        </div>
                    </a>
                    <!-- <dropdown-component name="Reportes" :items="ReportsMenu" class="md:relative md:hidden" />
                    <dropdown-component name="Configuración" :items="ConfigMenu" class="md:relative lg:hidden" /> -->
                    <!-- <a href="/sales/create/?queryType=sell" class="
                            sm:hidden
                            border border-t border-b border-gray-300
                            mt-2
                            p-2
                            rounded-sm
                            bg-gray-300
                            lg:mt-0
                            text-blue-700
                            sm:hover:text-blue-800
                            md:text-base
                            text-lg
                        ">
                        <div class="
                                flex flex-wrap
                                items-center
                                justify-center
                                font-mono
                            ">
                            <shopping-bag></shopping-bag>
                            <span class="self-end leading-none font-xl font-bold">Ventas</span>
                        </div>
                    </a> -->
                </div>
                <div class="flex flex-wrap items-center w-full sm:w-auto">
                    <form v-if="impersonation_id" action="/impersonations" method="post" class="
                            block
                            mt-4
                            lg:inline-block lg:mt-0
                            md:hover:text-white
                            mr-4
                        ">
                        <input type="hidden" name="_method" value="delete" />
                        <input type="hidden" name="_token" :value="crfsToken" />
                        <button class="
                                text-gray-300
                                border-red-900 border
                                rounded
                                px-2
                                py-1
                            ">
                            Regresar <i class="fas fa-user"></i>
                        </button>
                    </form>
                    <form action="/logout" method="POST" class="w-full sm:w-auto">
                        <input type="hidden" name="_token" :value="crfsToken" />
                        <button href="/logout" class="
                                inline-block
                                w-full
                                sm:w-auto
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
                            ">
                            {{ getCurrentUser.name }} | Salir
                        </button>
                    </form>
                </div>
            </div>
            <div id="mobile-menu" class="hidden sm:hidden  relative border-t pt-2 w-full mt-3  ">
                <submenu-container name="Catalagos">
                    <template slot="descriptive-icon">

                        <view-boards class="mr-2 h-6 w-6 text-sky-500   rounded-sm"></view-boards>

                    </template>
                    <template slot="icon">
                        <dots-vertical class=" h-7 w-7 p-1 text-primary  rounded-sm"></dots-vertical>
                    </template>
                    <template slot="list">
                        <li class="bg-slate-100">
                            <accordion :items-menu="clientsMenu" :is-submenu="true" name="Clientes">
                                <template slot="descriptive-icon">
                                    <users-icon class="mr-2 h-7 w-7 p-1 rounded-sm"></users-icon>
                                </template>
                                <template slot="icon">
                                    <down-arrow class="text-xs h-4 w-4"></down-arrow>
                                </template>
                            </accordion>
                        </li>
                        <li class="bg-slate-100">
                            <accordion textColor="text-white" :items-menu="ProductsMenu" :is-submenu="true"
                                name="Productos">
                                <template slot="descriptive-icon">
                                    <star class="mr-2 h-7 w-7 p-1 rounded-sm"></star>
                                </template>
                                <template slot="icon">
                                    <down-arrow class="text-xs h-4 w-4"></down-arrow>
                                </template>
                            </accordion>
                        </li>
                        <li class="bg-slate-100">
                            <accordion textColor="text-white" :items-menu="WarehousesMenu" :is-submenu="true"
                                name="Almacenes">
                                <template slot="descriptive-icon">
                                    <view-grid-icon class="mr-2 h-7 w-7 p-1 rounded-sm"></view-grid-icon>
                                </template>
                                <template slot="icon">
                                    <down-arrow class="text-xs h-4 w-4"></down-arrow>
                                </template>
                            </accordion>
                        </li>
                        <li class="bg-slate-100">
                            <accordion textColor="text-white" :items-menu="CategoriesMenu" :is-submenu="true"
                                name="Categorías">
                                <template slot="descriptive-icon">
                                    <color-swatch class="mr-2 h-7 w-7 p-1 rounded-sm"></color-swatch>
                                </template>
                                <template slot="icon">
                                    <down-arrow class="text-xs h-4 w-4"></down-arrow>
                                </template>
                            </accordion>
                        </li>
                    </template>
                </submenu-container>
                <accordion :is-submenu="false" :items-menu="movementsMenu" name="Movimientos">
                    <template slot="descriptive-icon">
                        <switch-horizontal class="mr-2 h-7 w-7 p-1 text-gray-700 rounded-sm"></switch-horizontal>
                    </template>
                    <template slot="icon">
                        <down-arrow class="text-xs w-6 h-6"></down-arrow>
                    </template>
                </accordion>
                <accordion class="" :items-menu="ReportsMenu" name="Reportes">
                    <template slot="descriptive-icon">
                        <bars-icon class="mr-2 h-7 w-7 p-1 text-gray-700 rounded-sm"></bars-icon>
                    </template>
                    <template slot="icon">
                        <down-arrow class="text-xs w-6 h-6"></down-arrow>
                    </template>
                </accordion>
                <accordion class="" :items-menu="ConfigMenu" name="Configuración">
                    <template slot="descriptive-icon">
                        <setting-icon class="mr-2 h-7 w-7 p-1 text-gray-700 rounded-sm"></setting-icon>
                    </template>
                    <template slot="icon">
                        <down-arrow class="text-xs w-6 h-6"></down-arrow>
                    </template>
                </accordion>
            </div>
        </nav>

        <!-- Page Content -->
        <main class="mt-20 w-full z-0 flex flex-col flex-1 mb-4">
            <sidebar>
                <submenu-container name="Catalagos">
                    <template slot="descriptive-icon">
                        <view-boards class="mr-2 h-7 w-7 p-1 text-primary rounded-sm"></view-boards>
                    </template>
                    <template slot="icon">
                        <dots-vertical class=" h-7 w-7 p-1 text-slate-400 rounded-sm"></dots-vertical>
                    </template>
                    <template slot="list">
                        <li class="pl-3">
                            <accordion :items-menu="clientsMenu" :is-submenu="true" name="Clientes">
                                <template slot="descriptive-icon">
                                    <users-icon class="mr-2 h-7 w-7 p-1 text-primary rounded-sm"></users-icon>
                                </template>
                                <template slot="icon">
                                    <down-arrow class="text-xs h-4 w-4 text-slate-400"></down-arrow>
                                </template>
                            </accordion>
                        </li>
                        <li class="pl-3">
                            <accordion textColor="text-white" :items-menu="ProductsMenu" :is-submenu="true"
                                name="Productos">
                                <template slot="descriptive-icon">
                                    <star class="mr-2 h-7 w-7 p-1 text-primary rounded-sm"></star>
                                </template>
                                <template slot="icon">
                                    <down-arrow class="text-xs text-slate-400 h-4 w-4"></down-arrow>
                                </template>
                            </accordion>
                        </li>
                        <li class="pl-3">
                            <accordion textColor="text-white" :items-menu="WarehousesMenu" :is-submenu="true"
                                name="Almacenes">
                                <template slot="descriptive-icon">
                                    <view-grid-icon class="mr-2 h-7 w-7 text-primary p-1 rounded-sm"></view-grid-icon>
                                </template>
                                <template slot="icon">
                                    <down-arrow class="text-xs h-4 text-slate-400 w-4"></down-arrow>
                                </template>
                            </accordion>
                        </li>
                        <li class="pl-3">
                            <accordion textColor="text-white" :items-menu="CategoriesMenu" :is-submenu="true"
                                name="Categorías">
                                <template slot="descriptive-icon">
                                    <color-swatch class="mr-2 h-7 w-7 text-primary p-1 rounded-sm"></color-swatch>
                                </template>
                                <template slot="icon">
                                    <down-arrow class="text-xs text-slate-400 h-4 w-4"></down-arrow>
                                </template>
                            </accordion>
                        </li>
                    </template>
                </submenu-container>
                <accordion :is-submenu="false" :items-menu="movementsMenu" name="Movimientos">
                    <template slot="descriptive-icon">
                        <switch-horizontal class="mr-2 h-7 w-7 p-1 text-primary rounded-sm"></switch-horizontal>
                    </template>
                    <template slot="icon">
                        <down-arrow class="text-xs w-6 h-6 text-slate-400"></down-arrow>
                    </template>
                </accordion>
                <accordion class="" :items-menu="ReportsMenu" name="Reportes">
                    <template slot="descriptive-icon">
                        <bars-icon class="mr-2 h-7 w-7 p-1 text-primary rounded-sm"></bars-icon>
                    </template>
                    <template slot="icon">
                        <down-arrow class="text-xs w-6 text-slate-400 h-6"></down-arrow>
                    </template>
                </accordion>
                <accordion class="" :items-menu="ConfigMenu" name="Configuración">
                    <template slot="descriptive-icon">
                        <setting-icon class="mr-2 h-7 w-7 p-1 text-primary rounded-sm"></setting-icon>
                    </template>
                    <template slot="icon">
                        <down-arrow class="text-xs w-6 h-6 text-slate-400"></down-arrow>
                    </template>
                </accordion>
            </sidebar>
            <div class="flex-1 sm:ml-64">
                <slot />
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
import ViewGridIcon from "./icons/ViewGridIcon.vue";
import SubmenuContainer from "./menu/SubmenuContainer";
import UsersIcon from "./icons/UsersIcon.vue";
import DownArrow from "./icons/DownArrow.vue";
import BarsIcon from "./icons/BarsIcon.vue";
import DotsVertical from "./icons/DotsVertical.vue";
import SettingIcon from "./icons/SettingIcon.vue";
import ViewBoards from "./icons/ViewBoards.vue";
import Star from "./icons/Star.vue";
import ColorSwatch from "./icons/ColorSwatch.vue";
import SwitchHorizontal from "./icons/SwitchHorizontal.vue";
import menuData from "../utilities/menu";
export default {
    components: {
        SwitchHorizontal,
        ColorSwatch,
        ViewBoards,
        SettingIcon,
        BarsIcon,
        UsersIcon,
        SubmenuContainer,
        ViewGridIcon,
        Sidebar,
        Accordion,
        WarehouseIcon,
        ShoppingBag,
        DownArrow,
        DotsVertical,
        Star,
    },
    data() {
        return {
            ...menuData,
            crfsToken: document.querySelector('meta[name="csrf-token"]')
                .content,
            purchase: false,
            impersonation_id: document.querySelector(
                'meta[name="impersonation_id"]'
            ).content,
            show: false,
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
        toggleNavigation() {
            this.show = !this.show;
            document.querySelector("#mobile-menu").classList.toggle("hidden")
            const nav = document.querySelector("nav");
            nav.classList.toggle("max-h-16")
            nav.classList.toggle("h-16")
            nav.classList.toggle("h-auto")
            nav.classList.toggle("max-h-screen")
            nav.classList.toggle("overflow-y-hidden")
            nav.classList.toggle("overflow-y-scroll")
            nav.classList.toggle('fixed')
            nav.classList.toggle("absolute")
            // document.querySelector("#navigation").classList.toggle("h-screen");
            // document.querySelector("#navigation").classList.toggle("h-0");
            // document.querySelector("#navigation").classList.toggle("hidden");
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
        enter(el) {
            console.log("entro");
            el.style.height = "100vh";
            const height = "100vh";
            el.style.height = 0;
            getComputedStyle(el);
            setTimeout(() => {
                el.style.height = height;
            });
        },
        afterEnter(el) {
            el.style.height = "100vh";
        },
        leave(el) {
            el.style.height = getComputedStyle(el).height;
            getComputedStyle(el);
            setTimeout(() => {
                el.style.height = 0;
            });
        },
    },
    computed: {
        highlight() {
            return this.purchase
                ? "text-lg text-black-700 border-teal-300 border-b-2"
                : "text-gray-200";
        },
        getShow() { },
    },
};
</script>
