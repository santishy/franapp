<template>
    <div>
        <form @submit.prevent="submit">
             <div class="flex items-center border-b border-teal-500 py-2">
                    <select
                        name="category_id"
                        v-model="form.category_id"
                        plahceholder="Elige una categoria"
                        class="block appearance-none w-full bg-white hover:border-gray-500 px-4 py-2 pr-8 rounded leading-tight focus:outline-none focus:shadow-outline"
                    >
                        <option disabled value="" selected class="text-gray-600"
                            >Categorías</option
                        >
                        <option
                            v-for="category in categories"
                            :key="category.id"
                            :value="category.id"
                            >{{ category.name }}</option
                        >
                    </select>
                    <div
                        class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700"
                    >
                        <svg
                            class="fill-current h-4 w-4"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20"
                        >
                            <path
                                d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"
                            />
                        </svg>
                    </div>
                </div>
        </form>
    </div>
</template>
<script>


export default {
    props:{
        categories:{
            type:Array
        }
    },
    data(){
        return{
            category_id:'',
        }
    }
}
</script>
