<template>
    <table>
        <thead>
            <tr>
                <th>SKU</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <tr 
                v-for="product in products"
                :key=""
            >

            </tr>
        </tbody>
    </table>
</template>