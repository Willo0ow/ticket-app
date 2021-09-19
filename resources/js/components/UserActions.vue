<template>
  <v-row>
    <v-col cols="12">
      <v-expansion-panels v-model="panel" flat tile popout inset>
        <v-expansion-panel>
          <v-expansion-panel-header
            >Request the ticket to be assigned to you</v-expansion-panel-header
          >
          <v-expansion-panel-content>
            <div>
              Why do you want the ticket to be assigned to You? (optional)
            </div>
            <v-textarea v-model="message"></v-textarea>
            <v-btn @click="sendAssignmentRequest">Send</v-btn>
            <v-btn @click="cancel">Cancel</v-btn>
          </v-expansion-panel-content>
        </v-expansion-panel>
      </v-expansion-panels>
    </v-col>
  </v-row>
</template>
<script>
export default {
  props: {
    ticketId: { type: Number, required: true },
    authUserId: { type: Number, required: true },
    userDept: { type: Number, required: true },
  },
  data() {
    return {
      message: "",
      panel: false,
    };
  },
  methods: {
    async sendAssignmentRequest() {
      await axios.post("/api/assignmentrequest", {
        ticket_id: this.ticketId,
        request_user_id: this.authUserId,
        dept_id: this.userDept,
        message: this.message,
      });
      this.cancel();
    },
    cancel() {
      this.message = "";
      this.panel = false;
    },
  },
};
</script>