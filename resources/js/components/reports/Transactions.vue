<template>
    <div class="w-3/5 mx-auto shadow  pb-4 bg-white mt-24 md:mt-32">
        <h1
            class="font-extrabold text-gray-700  text-center border-b-2 border-gray-300 py-3 text-2xl"
        >
            Reporte de {{name}}
        </h1>
        <transition name="fade">
            <div v-if="total != null" class="w-full bg-blue-600 border-b-2 py-3 text-white border-gray-300 flex justify-center items-center">
                <span class="font-semibold text-xl ">Total:</span>
                <div class="font-bold text-2xl ml-2">${{total}}</div>
            </div>
        </transition>
        <report-by class="mt-4"></report-by>
    </div>
</template>
<script>
import ReportBy from "./ReportBy.vue";
export default {
    components:{ReportBy},
    props:{
        name:{
            type:String
        }
    },
    data(){
        return{
            total:null
        }
    },
    mounted(){
        EventBus.$on('calculated-total', total => {
            this.total = total
        })
    }
};
</script>
