<template>
    <div class="w-full shadow  pb-4 bg-white mt-24 md:mt-32">
        <h1
            class="font-extrabold text-center border-b-2 border-gray-300 py-3 text-2xl"
        >
            Reporte de {{name}}
        </h1>
        <div v-if="total != null" class="w-full">
            <span>Total:</span>
            <div>{{total}}</div>
        </div>
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
        EventBus.$on('')
    }
};
</script>
