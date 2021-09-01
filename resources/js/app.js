require('./bootstrap');
import router from "./router";
import vuetify from "./vuetify";
import store from "./store";

window.Vue = require('vue').default;
Vue.component("Home", require("./Pages/Home.vue").default)

const app = new Vue({
    store,
    vuetify,
    router,
    el: '#app',
});
