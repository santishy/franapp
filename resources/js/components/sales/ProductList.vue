<template>
    <div class="relative overflow-x-auto bg-slate-100">
        <table class="w-full bg-slate-100 table-auto text-sm text-center text-gray-500">
            <thead class="font-mono  text-gray-700 uppercase border-b-2 border-white">
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
            <tbody class="divide-y divide-white">
                <slot></slot>
            </tbody>
        </table>
    </div>
</template>
