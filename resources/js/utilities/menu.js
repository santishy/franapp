const menuData = {
    catalogs: [
        {
            name: "Clientes",
            url: "#",
        },
        {
            name: "Proveedores",
            url: "#",
        },
        {
            name: "Productos",
            url: "#",
        },
        {
            name: "Almacenes",
            url: "#",
        },
        {
            name: "Categorias",
            url: "#",
        },
    ],
    movementsMenu: [
        {
            name: "Ventas",
            url: "/sales/create/?queryType=sell",
        },
        {
            name: "Compras",
            url: "/products/?queryType=toBuy",
        },
        {
            name: "Existencias",
            url: "/inventories",
        },
    ],
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
    WarehousesMenu: [
        {
            name: "Nuevo almacen",
            url: "/inventories/create",
        },
        {
            name: "Lista de almacenes",
            url: "/warehouses",
        },
        {
            name: "Existencias",
            url: "/inventories",
        },
    ],
    CategoriesMenu: [
        {
            name: "Nueva categoría",
            url: "/categories",
        },
    ],
    InventoryMenu: [
        {
            name: "Nuevo almacen",
            url: "/inventories/create",
        },
        {
            name: "Lista de almacenes",
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
    ProductsMenu: [
        {
            name: "Nuevo producto",
            url: "/products/create",
        },
        {
            name: "Catalago",
            url: "/products/?queryType=list",
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
}

module.exports = menuData;
