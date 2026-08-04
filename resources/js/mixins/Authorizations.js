import { mapGetters, mapState } from 'vuex';
export default {

    computed:{
        ...mapState(['auth','user']),
        ...mapGetters(['isAdmin','getCurrentUser'])
    }
}
