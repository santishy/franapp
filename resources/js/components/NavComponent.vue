<template>
    <nav
        class="flex items-center justify-between flex-wrap bg-red-500 p-6 fixed w-full top-0"
    >
        <div class="flex items-center flex-shrink-0 text-white mr-6 ">
            <span class="font-semibold text-xl tracking-tight">ISCO</span>
        </div>
        <div @click="toggleNavegation" class="block lg:hidden">
            <button
                class="flex items-center px-3 py-2 border rounded text-teal-200 border-teal-400 hover:text-white hover:border-white"
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
            class="w-full block flex-grow lg:flex lg:items-center lg:w-auto hidden"
        >
            <div class="text-sm lg:flex-grow">
                <dropdown-component
                    name="Productos"
                    :items="productsMenu"
                    class="md:relative"
                />
                <a
                    v-if="purchase"
                    :href="purchase ? `/purchases/${purchase}` : '#'"
                    :class="highlight"
                    class="block mt-4 lg:inline-block lg:mt-0  md:hover:text-white mr-4"
                >
                    Realizar Compra
                </a>
                <dropdown-component
                    name="Clientes"
                    :items="clientsMenu"
                    class="md:relative"
                />
                <a
                    href="/sales/create"
                    class="block mt-4 lg:inline-block lg:mt-0 text-gray-200 md:hover:text-white mr-4 md:text-base text-lg"
                >
                    Vender
                </a>
                <dropdown-component
                    name="Reportes"
                    :items="ReportsMenu"
                    class="md:relative"
                />
                <dropdown-component
                    name="Usuarios"
                    :items="UsersMenu"
                    class="md:relative"
                />
                <a
                    href="/roles/create"
                    class="block mt-4 lg:inline-block lg:mt-0 text-gray-200 md:hover:text-white mr-4 md:text-base text-lg"
                >
                    Roles
                </a>
            </div>
            <div>
                <form action="/logout" method="POST">
                    <input type="hidden" name="_token" :value="crfsToken" />
                    <button
                        href="/logout"
                        class="inline-block text-sm px-4 py-2 leading-none border rounded text-white border-white hover:border-transparent md:hover:text-teal-500 md:hover:bg-white mt-4 lg:mt-0"
                    >
                        Cerrar sesión
                    </button>
                </form>
            </div>
        </div>
    </nav>
</template>
<script>
export default {
    data() {
        return {
            productsMenu: [
                {
                    name: "Añadir",
                    url: "/products/create"
                },
                {
                    name: "Listar",
                    url: "/products"
                }
            ],
            clientsMenu: [
                {
                    name: "Añadir",
                    url: "/clients/create"
                },
                {
                    name: "Listar",
                    url: "/clients"
                }
            ],
            ReportsMenu: [
                {
                    name: "Ventas",
                    url: "/sales/"
                },
                {
                    name: "Compras",
                    url: "/purchases"
                }
            ],
            UsersMenu: [
                {
                    name: "Registrar",
                    url: "/register/"
                },
                {
                    name: "Listar",
                    url: "/users"
                }
            ],
            crfsToken: document.querySelector('meta[name="csrf-token"]')
                .content,
            purchase: false
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
        }
    },
    computed: {
        highlight() {
            return this.purchase
                ? "text-lg text-black-700 border-teal-300 border-b-2"
                : "text-gray-200";
        }
    }
};
</script>
