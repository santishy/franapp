const { mapGetters, mapState } = require("vuex");

module.exports = 
{
    computed:{
        ...mapState(['auth','user']),
        ...mapGetters(['isAdmin'])
    }
}