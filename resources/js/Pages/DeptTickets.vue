<template>
  <v-container>
    <v-card-title>Department Tickets</v-card-title>
    <ticket-list
      :tickets="tickets"
      :actionOne="viewTicket"
      actionOneTitle="View"
    ></ticket-list>
    <v-dialog v-model="isEditVisible">
      <ticket-card
        v-if="selectedTicket"
        :ticketId="selectedTicket"
        :readonly="false"
        :closeFunction="closeEditTicket"
        :userId="authUser"
      >
        <template v-slot:userActions>
          <user-actions
            :userDept="userDept"
            :ticketId="selectedTicket"
            :authUserId="authUser"
          ></user-actions>
        </template>
      </ticket-card>
    </v-dialog>
  </v-container>
</template>
<script>
import { mapState, mapActions } from "vuex";
import TicketList from "../components/TicketList.vue";
import UserActions from "../components/UserActions.vue";
import TicketCard from "../components/TicketCard.vue";

export default {
  components: {
    TicketList,
    UserActions,
    TicketCard,
  },
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
    async viewTicket(id) {
      this.selectedTicket = id;
      this.isEditVisible = true;
    },
    async closeEditTicket() {
      this.isEditVisible = false;
      this.selectedTicket = null;
      await this.getDeptTickets();
    },
  },
  async beforeMount() {
    await this.getDeptTickets();
  },
};
</script>
