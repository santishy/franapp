<template>
    <div class="relative overflow-x-auto bg-white">
        <table class="w-full table-auto text-sm text-center text-gray-500">
            <thead class="text-xs font-mono border-b-2 border-gray-100 text-gray-700 uppercase  dark:text-gray-400">
                <tr>
                    <th class="py-2 px-2">Imagen</th>
                    <th class="py-2 px-2">SKU</th>
                    <th class="py-2 px-2">Descripción</th>
                    <th class="py-2 px-2">Cantidad</th>
                    <th class="py-2 px-2">Precio</th>
                    <th class="py-2 px-2">Importe</th>
                    <th class="py-2 px-2">Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <slot></slot>
            </tbody>
        </table>
    </div>
</template>
