<template>

    <form class="w-4/12 mx-auto bg-white rounded shadow-md px-4 py-2 mt-24 md:mt-32">
        <div class="mb-4">
            <h3 class="text-xl">Registrar</h3>
        </div>
        <div class="mb-4">
            <label
                class="block text-gray-700 text-sm font-bold mb-2"
                for="username"
            >
                Nombre
            </label>
            <input
                name="name"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="name"
                type="text"
                placeholder="example@test.com"
            />
        </div>
        <div class="mb-4">
            <label
                class="block text-gray-700 text-sm font-bold mb-2"
                for="username"
            >
                Email
            </label>
            <input
                name="email"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="email"
                type="text"
                placeholder="example@test.com"
            />
        </div>
        <div class="mb-4">
            <label
                class="block text-gray-700 text-sm font-bold mb-2"
                for="username"
            >
                Password
            </label>
            <input
                name="password"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="password"
                type="password"
                placeholder="example@test.com"
            />
        </div>

        <div class="mb-4">
            <label
                class="block text-gray-700 text-sm font-bold mb-2"
                for="username"
            >
                Confirma Password
            </label>
            <input
                name="password_confirmation"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="password_confirmation"
                type="password"
                placeholder="example@test.com"
            />
        </div>
        <button
            class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded"
        >
            Guardar
        </button>
    </form>
</template>
