<template>
    <v-container>
        <v-card-title>Department Tickets</v-card-title>
        <ticket-list
            :tickets="tickets"
            :actionOne="viewTicket"
            actionOneTitle="View"
        ></ticket-list>
        <v-dialog v-model="isEditVisible">
            <ticket-edit :ticket="selectedTicket">
                <template v-slot:actions v-if="deptUsers.length">
                    <v-select
                    class="ml-auto"
                    style="max-width:200px"
                        :items="deptUsers"
                        item-text="name"
                        persistent-hint
                        filled
                        rounded
                        dense
                        hint="Assigned user"
                        single-line
                        item-value="id"
                        v-model="assignedUser"
                        @change="assignUserToTicket($event)"
                    ></v-select>
                </template>
            </ticket-edit>
        </v-dialog>
    </v-container>
</template>
<script>
import { mapState, mapActions } from "vuex";
import TicketEdit from "../components/TicketEdit.vue";
import TicketList from "../components/TicketList.vue";

export default {
    components: { TicketList, TicketEdit },
    name: "DeptTickets",
    data() {
        return {
            tickets: [],
            isEditVisible: false,
            selectedTicket: {},
            deptUsers: [],
            assignedUser: null
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
        async getDeptUsers() {
            const { data } = await axios.get(
                `/api/departmentusers/${this.userDept}`
            );
            this.deptUsers = data;
        },
        viewTicket(id) {
            this.selectedTicket = this.tickets.find(ticket => ticket.id === id);
            this.isEditVisible = true;
        },
        async assignUserToTicket(assignedUser){
            await axios.patch(`/api/ticketupdate/${this.selectedTicket.id}`, {assignees: JSON.stringify([assignedUser])});
        }
    },
    async beforeMount() {
        await this.getDeptTickets();
        await this.getDeptUsers();
    }
};
</script>
