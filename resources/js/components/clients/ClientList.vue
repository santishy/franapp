<template>
    <table class="table-auto">
        <thead>
            <tr>
                <th class="px-4 py-2">Nombre</th>
                <th class="px-4 py-2">Dirección</th>
                <th class="px-4 py-2">Número tel.</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="border px-4 py-2">Intro to CSS</td>
                <td class="border px-4 py-2">Adam</td>
                <td class="border px-4 py-2">858</td>
            </tr>
            <tr class="bg-gray-100">
                <td class="border px-4 py-2">
                    A Long and Winding Tour of the History of UI Frameworks and
                    Tools and the Impact on Design
                </td>
                <td class="border px-4 py-2">Adam</td>
                <td class="border px-4 py-2">112</td>
            </tr>
            <tr>
                <td class="border px-4 py-2">Intro to JavaScript</td>
                <td class="border px-4 py-2">Chris</td>
                <td class="border px-4 py-2">1,280</td>
            </tr>
        </tbody>
    </table>
</template>
<script>
export default {
    props:{
        clients:{
            type:Array,
            required:true
        }
    }
}
</script>