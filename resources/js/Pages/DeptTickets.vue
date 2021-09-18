<template>
  <v-container>
    <v-card-title>Department Tickets</v-card-title>
    <ticket-list
      :tickets="tickets"
      :actionOne="viewTicket"
      actionOneTitle="View"
    ></ticket-list>
    <v-dialog v-model="isEditVisible">
      <ticket-edit :ticket="selectedTicket" :closeFunction="closeEditTicket">
        <template v-slot:actions v-if="deptUsers.length">
          <supervisor-actions
            :deptUsers="deptUsers"
            :ticketDept="selectedTicket.dept_id"
            :ticketId="selectedTicket.id"
            :ticketPriority="selectedTicket.priority"
            :ticketDeadline="selectedTicket.deadline"
            :getTickets="getDeptTickets"
          ></supervisor-actions>
          <user-actions
            :userDept="userDept"
            :ticketId="selectedTicket.id"
            :authUserId="authUser"
          ></user-actions>
        </template>
      </ticket-edit>
    </v-dialog>
  </v-container>
</template>
<script>
import { mapState, mapActions } from "vuex";
import TicketEdit from "../components/TicketEdit.vue";
import TicketList from "../components/TicketList.vue";
import SupervisorActions from "../components/SupervisorActions.vue";
import UserActions from "../components/UserActions.vue";

export default {
  components: { TicketList, TicketEdit, SupervisorActions, UserActions },
  name: "DeptTickets",
  data() {
    return {
      tickets: [],
      isEditVisible: false,
      selectedTicket: {},
      deptUsers: [],
    };
  },
  computed: {
    ...mapState({
      userDept: (state) =>
        state.authUser ? state.authUser.department_id : null,
      authUser: (state) => (state.authUser ? state.authUser.id : null),
    }),
  },
  methods: {
    ...mapActions(["getUserInfo"]),
    async getDeptTickets() {
      if (!this.userDept) {
        await this.getUserInfo();
      }
      const { data } = await axios.get(`/api/depttickets/${this.userDept}`);
      this.tickets = data;
    },
    async getDeptUsers() {
      const { data } = await axios.get(`/api/departmentusers/${this.userDept}`);
      this.deptUsers = data;
    },
    async viewTicket(id) {
      const {data} = await axios.get(`/api/ticket/${id}`)
      this.selectedTicket = data;
      this.isEditVisible = true;
    },
    closeEditTicket() {
      this.isEditVisible = false;
    },
  },
  async beforeMount() {
    await this.getDeptTickets();
    await this.getDeptUsers();
  },
};
</script>
