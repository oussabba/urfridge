import axios from "axios";

const state = {
    user:{ }
};
const getters = {};
const actions = {

    getUser({commit}) {
        axios.get("/api/current")
            .then(response => {
                commit('setUser', response.data);
            });
     },

    loginUser({},user) {
        axios.post("/api/login", {
            email: user.email,
            password: user.password
        })
            .then(response => {
                if (response.data.token) {
                    //save token
                    localStorage.setItem(
                        "userToken",
                        response.data.token
                    )
                    window.location.replace("/dashboard")
                }
            })
            .catch(error => {
                console.log(error);
            });
    }
};
const mutations = {
    setUser(state, data) {
        state.user=data
    }
};

export default {
    namespaced=true,
    state,
    getters,
    actions,
    mutations
}
