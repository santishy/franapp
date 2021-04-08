module.exports = {
    data:()=>{
        return {
            errors:null
        }
    },
    methods:{
        getErrors(err){
            if (err?.response?.status === 403) {
                return window.location.href='/403';
            }
            this.errors = Object.values(
                err.response.data.errors
            ).flat()
        }
    }
}