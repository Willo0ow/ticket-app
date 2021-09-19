<template>
  <v-card>
    <v-card-title class="d-flex justify-space-between">
      <div>{{ ticket.title }}</div>
      <v-text-field
        :readonly="readonly"
        single-line
        style="max-width: 200px"
        persistent-hint
        filled
        rounded
        dense
        hint="Registration Date"
        :value="ticket.created_at"
      ></v-text-field>
    </v-card-title>
    <v-card-text>
      <v-container fluid>
        <v-row>
          <v-col>
            <v-textarea
            rows="4"
            :auto-grow="true"
              :readonly="readonly"
              persistent-hint
              filled
              rounded
              dense
              hint="Content"
              :value="ticket.content"
            ></v-textarea>
          </v-col>
        </v-row>
        <v-row>
          <v-col>
            <v-text-field
              :readonly="readonly"
              single-line
              style="max-width: 200px"
              persistent-hint
              filled
              rounded
              dense
              hint="Deadline"
              :value="ticket.deadline"
            ></v-text-field>
          </v-col>
          <v-col>
            <v-select
              :readonly="readonly"
              :value="ticket.priority"
              :items="priorities"
              item-text="text"
              item-value="value"
              persistent-hint
              filled
              rounded
              dense
              hint="Priority"
              single-line
              style="max-width: 200px"
            ></v-select>
          </v-col>
          <v-col>
            <v-select
              :readonly="readonly"
              class="ml-auto"
              style="max-width: 200px"
              :items="deptUsers"
              item-text="name"
              persistent-hint
              filled
              rounded
              dense
              hint="Assigned user"
              single-line
              item-value="id"
              :value="ticket.assignees"
              multiple
            ></v-select>
          </v-col>
          <v-col>
            <v-text-field
              :readonly="readonly"
              single-line
              style="max-width: 200px"
              persistent-hint
              filled
              rounded
              dense
              hint="Registered by"
              :value="ticket.user_name"
            ></v-text-field>
          </v-col>
        </v-row>
        <v-row id="comments">
            <v-col cols="12">
                <v-card-subtitle>Comments</v-card-subtitle>
            </v-col>
          <v-col cols="12" v-for="(comment, index) of comments" :key="index">
            <v-textarea
            rows="2"
            :auto-grow="true"
              :value="comment.content"
              readonly
              persistent-hint
              filled
              rounded
              dense
              :hint="`${comment.user_name} ${comment.created_at}`"
            ></v-textarea>
          </v-col>
          <v-row>
            <v-expansion-panels v-model="commentPanel" flat tile popout inset>
              <v-expansion-panel>
                <v-expansion-panel-header>Add Comment</v-expansion-panel-header>
                <v-expansion-panel-content>
                  <v-textarea
                  rows="2"
                  :auto-grow="true"
                    filled
                    rounded
                    dense
                    v-model="newComment"
                  ></v-textarea>
                  <v-btn @click="saveComment">Send</v-btn>
                  <v-btn @click="cancelComment">Cancel</v-btn>
                </v-expansion-panel-content>
              </v-expansion-panel>
            </v-expansion-panels>
          </v-row>
        </v-row>
      </v-container>
    </v-card-text>
    <v-card-actions>
        <v-btn @click="close">Close</v-btn>
    </v-card-actions>
  </v-card>
</template>
<script>
import priorities from "../mixins/priorities";
import getDepts from "../mixins/getDepts";

export default {
  mixins: [priorities, getDepts],
  props: {
    ticketId: {
      type: Number,
      required: true,
    },
    readonly: {
      type: Boolean,
      required: false,
      default: false,
    },
    closeFunction: {
        type: Function,
        required: true,
    }
  },
  data() {
    return {
      defaultTicket: {
        title: "",
        content: "",
        deadline: "",
        priority: 1,
        assignees: [],
        user_id: null,
      },
      ticket: {},
      comments: [],
      deptUsers: [],
      commentPanel: false,
      newComment: "",
    };
  },
  methods: {
    async getTicket() {
      const { data: ticket } = await axios.get(`/api/ticket/${this.ticketId}`);
      ticket.assignees = await JSON.parse(ticket.assignees);
      ticket.assignees = ticket.assignees ? ticket.assignees : [];
      this.ticket = ticket;
      const { data: comments } = await axios.get(
        `/api/ticketcomments/${this.ticketId}`
      );
      this.comments = comments;
    },
    async getDeptUsers() {
      const { data } = await axios.get(
        `/api/departmentusers/${this.ticket.dept_id}`
      );
      this.deptUsers = data;
    },
    async saveComment() {
      const form = {
        content: this.newComment,
        user_id: this.ticket.user_id,
        ticket_id: this.ticket.id,
      };
      const { data: comment } = await axios.post("/api/comment", form);
      this.comments.push(comment);
      this.cancelComment();
    },
    cancelComment() {
      this.commentPanel = false;
      this.newComment = "";
    },
    close(){
        this.ticket = {...this.defaultTicket};
        this.comments = [];
        this.deptUsers = [];
        this.closeFunction();
    }
  },
  async beforeMount() {
    await this.getTicket();
    await this.getDeptUsers();
  },
  async created() {
    this.ticket = { ...this.defaultTicket };
  },
};
</script>