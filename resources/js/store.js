import axios from "axios";
import vue from "vue";
import Vuex from "vuex";
vue.use(Vuex);

export default new Vuex.Store({
    state: {
        authUser: null,
    },
    mutations: {
        setAuthUser(state, payload){
            state.authUser = payload;
        }
    },
    actions: {
        async getUserInfo({commit}){
            const {data} = await axios.get('/authuser')
            commit('setAuthUser', data);
        }
    }
})
