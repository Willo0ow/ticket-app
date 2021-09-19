<template>
  <v-container>
    <v-card-title>User Tickets</v-card-title>
    <ticket-list
      :tickets="tickets"
      :actionOne="viewTicket"
      actionOneTitle="View"
    ></ticket-list>
    <v-dialog v-model="isEditVisible">
      <ticket-card
        v-if="selectedTicket"
        :ticketId="selectedTicket"
        :readonly="true"
        :closeFunction="closeTicket"
        :userId="userId"
      ></ticket-card>
    </v-dialog>
  </v-container>
</template>
<script>
import { mapState, mapActions } from "vuex";
import TicketList from "../components/TicketList.vue";
import TicketCard from "../components/TicketCard.vue";

export default {
  components: { TicketList, TicketCard },
  name: "UserTickets",
  data() {
    return {
      tickets: [],
      isEditVisible: false,
      selectedTicket: null,
    };
  },
  computed: {
    ...mapState({
      userId: (state) => (state.authUser ? state.authUser.id : null),
    }),
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
      this.selectedTicket = id;
      this.isEditVisible = true;
    },
    closeTicket() {
      this.isEditVisible = false;
      this.selectedTicket = null;
    },
  },
  async beforeMount() {
    await this.getUserTickets();
  },
};
</script>
