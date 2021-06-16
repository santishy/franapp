const { mapGetters, mapState, mapActions } = require("vuex");

module.exports = 
{
    methods:{
        ...mapActions(['getUser'])
    },
    computed:{
        ...mapState(['auth','user']),
        ...mapGetters(['isAdmin'])
    }
}