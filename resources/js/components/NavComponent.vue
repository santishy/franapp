<template>
    <nav class="flex items-center justify-between flex-wrap bg-red-500 p-6 fixed w-full top-0">
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
                    :href="purchase ? `/purchases/${purchase}` : '#'"
                    class="block mt-4 lg:inline-block lg:mt-0 text-gray-200 hover:text-white"
                >
                    Realizar Compra
                </a>
            </div>
            <div>
                <a
                    href="#"
                    class="inline-block text-sm px-4 py-2 leading-none border rounded text-white border-white hover:border-transparent hover:text-teal-500 hover:bg-white mt-4 lg:mt-0"
                    >Download</a
                >
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
                },
                
            ],
            purchase:null,
        };
    },
    mounted(){
        this.purchase =  document.head.querySelector('meta[name="purchase_id"]').content;
        EventBus.$on('purchase-created',this.setPurchaseId);
    },
    methods: {
        toggleNavegation() {
            document.querySelector("#navegation").classList.toggle("hidden");
        },
        setPurchaseId(id){
            this.purchase = id;
            console.log(this.purchase + ' uuuu')
        }
    }
};
</script>
