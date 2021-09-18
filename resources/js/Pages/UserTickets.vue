<template>
  <v-container>
    <v-card-title>User Tickets</v-card-title>
    <ticket-list
      :tickets="tickets"
      :actionOne="viewTicket"
      actionOneTitle="View"
    ></ticket-list>
    <v-dialog v-model="isEditVisible">
      <ticket-edit :ticket="selectedTicket" :closeFunction="closeTicket">
          <template v-slot:comments>
              <div>
                  <v-btn @click="addComment">Add comment</v-btn>
                  <div v-if="newCommentActive">

                  <v-text-field v-model="newComment"></v-text-field>
                  <div class="d-flex">
                      <v-btn color="success" @click="saveNewComment">Save</v-btn>
                      <v-btn color="warning" @click="cancelNewComment">Cancel</v-btn>
                  </div>
                  </div>
                  <p v-for="(comment, index) of selectedTicketComments" :key="index">{{comment.content}}</p>
              </div>
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
  components: { TicketEdit, TicketList },
  name: "UserTickets",
  data() {
    return {
      tickets: [],
      isEditVisible: false,
      selectedTicket: {},
      selectedTicketComments: [],
      newCommentActive: false,
      newComment: "",
    };
  },
  computed: {
    ...mapState({
      userId: (state) => (state.authUser ? state.authUser.id : null),
    }),
  },
  methods: {
      addComment(){
          this.newCommentActive = true;
      },
      cancelNewComment(){
          this.newCommentActive = false;
          this.newComment = "";
      },
      async saveNewComment(){
          const form = {
              content: this.newComment,
              user_id: this.userId,
              ticket_id: this.selectedTicket.id,
          };
          const {data: comment} = await axios.post('/api/comment', form);
          this.selectedTicketComments.push(comment);
          this.cancelNewComment();
      },
    ...mapActions(["getUserInfo"]),
    async getUserTickets() {
      if (!this.userDept) {
        await this.getUserInfo();
      }
      const { data } = await axios.get(`/api/usertickets/${this.userId}`);
      this.tickets = data;
    },
    async viewTicket(id) {
      const { data } = await axios.get(`/api/ticket/${id}`);
      data.assignees = await JSON.parse(data.assignees);
      data.assignees = data.assignees ? data.assignees : [];
      this.selectedTicket = data;
      const {data: comments} = await axios.get(`/api/ticketcomments/${id}`)
      this.selectedTicketComments = comments;
      this.isEditVisible = true;
    },
    closeTicket() {
      this.isEditVisible = false;
      this.selectedTicket = {};
    },
  },
  async beforeMount() {
    await this.getUserTickets();
  },
};
</script>
