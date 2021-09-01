import Vue from "vue";
import VueRouter from "vue-router";
import ExampleComponent from "./components/ExampleComponent.vue";

Vue.use(VueRouter);
const routes = [
    {
        path: "/home",
        component: ExampleComponent,
    }
]
const router = new VueRouter({
    mode: "history",
    base: process.env.BASE_URL,
    routes
  })
  export default router