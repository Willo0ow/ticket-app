import Vue from "vue";
import VueRouter from "vue-router";
import ExampleComponent from "./components/ExampleComponent.vue";
import Account from "./Pages/Account.vue";
import Settings from "./Pages/Settings.vue";
import Tickets from "./Pages/Tickets.vue";
import NewTicket from "./Pages/NewTicket.vue";
import UserTickets from "./Pages/UserTickets.vue";
import DeptTickets from "./Pages/DeptTickets.vue";
import Reports from "./Pages/Reports.vue"


Vue.use(VueRouter);
const routes = [
    {
        path: "/home",
        component: ExampleComponent,
    },
    {
        path: "/account",
        component: Account,
    },
    {
        path: "/settings",
        component: Settings,
    },
    {
        path: "/tickets",
        component: Tickets,
        children: [
            {
                path: "new",
                component: NewTicket
            },
            {
                path: "user",
                component: UserTickets
            },
            {
                path: "dept",
                component: DeptTickets
            }
        ]
    },
    {
        path: '/reports',
        component: Reports,
    }
]
const router = new VueRouter({
    mode: "history",
    base: process.env.BASE_URL,
    routes
  })
  export default router