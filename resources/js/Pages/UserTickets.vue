<template>
    <v-container>
        <v-card-title>User Tickets</v-card-title>
        <ticket-list
            :tickets="tickets"
            :actionOne="viewTicket"
            actionOneTitle="View"
        ></ticket-list>
        <v-dialog v-model="isEditVisible">
            <ticket-edit :ticket="selectedTicket"></ticket-edit>
        </v-dialog>
    </v-container>
</template>
<script>
import { mapState, mapActions } from "vuex";
import TicketEdit from "../components/TicketEdit.vue";
import TicketList from "../components/TicketList.vue";

export default {
    components: { TicketEdit, TicketList },
    name: "UserTickets",
    data() {
        return {
            tickets: [],
            isEditVisible: false,
            selectedTicket: {}
        };
    },
    computed: {
        ...mapState({
            userId: state => (state.authUser ? state.authUser.id : null)
        })
    },
    methods: {
        ...mapActions(["getUserInfo"]),
        async getUserTickets() {
            if (!this.userDept) {
                await this.getUserInfo();
            }
            const { data } = await axios.get(`/api/usertickets/${this.userId}`);
            this.tickets = data;
        },
        viewTicket(id) {
            this.selectedTicket = this.tickets.find(ticket => ticket.id === id);
            this.isEditVisible = true;
        }
    },
    async beforeMount() {
        await this.getUserTickets();
    }
};
</script>
