require('./bootstrap');
import router from "./router";
import vuetify from "./vuetify";
import store from "./store";

window.Vue = require('vue').default;
Vue.component("App", require("./App.vue").default)
const app = new Vue({
    el: '#app',
    store,
    vuetify,
    router,
});
