<template>
    <v-container>
        <v-card-title>Department Tickets</v-card-title>
        <ticket-list :tickets="tickets" :actionOne="viewTicket" actionOneTitle="View"></ticket-list>
        <v-dialog v-model="isEditVisible">
            <ticket-edit :ticket="selectedTicket"></ticket-edit>
        </v-dialog>
    </v-container>
</template>
<script>
import { mapState, mapActions } from "vuex";
import TicketEdit from '../components/TicketEdit.vue';
import TicketList from "../components/TicketList.vue";

export default {
    components: { TicketList, TicketEdit },
    name: "DeptTickets",
    data() {
        return {
            tickets: [],
            isEditVisible: false,
            selectedTicket: {},
        };
    },
    computed: {
        ...mapState({
            userDept: state =>
                state.authUser ? state.authUser.department_id : null
        })
    },
    methods: {
        ...mapActions(["getUserInfo"]),
        async getDeptTickets() {
            if (!this.userDept) {
                await this.getUserInfo();
            }
            const { data } = await axios.get(
                `/api/depttickets/${this.userDept}`
            );
            this.tickets = data;
        },
        viewTicket(id){
            this.selectedTicket = this.tickets.find((ticket)=>ticket.id === id)
            this.isEditVisible = true
        }
    },
    async beforeMount() {
        await this.getDeptTickets();
    }
};
</script>
