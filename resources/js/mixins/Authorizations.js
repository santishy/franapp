const { mapGetters, mapState, mapActions } = require("vuex");

module.exports = 
{
    created(){
        this.getUser();
    },
    methods:{
        ...mapActions(['getUser'])
    },
    computed:{
        ...mapState(['auth','user']),
        ...mapGetters(['isAdmin','getCurrentUser'])
    }
}