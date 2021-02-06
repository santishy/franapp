module.exports = {
    data:()=>{
        return {
            errors:null
        }
    },
    methods:{
        getErrors(){
            this.errors = Object.values(
                err.response.data.errors
            ).flat()
        }
    }
}