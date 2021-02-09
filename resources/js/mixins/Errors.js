module.exports = {
    data:()=>{
        return {
            errors:null
        }
    },
    methods:{
        getErrors(err){
            this.errors = Object.values(
                err.response.data.errors
            ).flat()
        }
    }
}