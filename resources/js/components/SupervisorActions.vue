<template>
  <div>
    <v-select
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
      :value="ticketAssignees"
      multiple
      @input="assignUserToTicket($event)"
    ></v-select>
    <v-select
      style="max-width: 200px"
      :items="depts"
      item-text="name"
      persistent-hint
      filled
      rounded
      dense
      hint="Change ticket's department"
      single-line
      item-value="id"
      @change="changeTicketDept($event)"
      :value="ticketDept"
    ></v-select>
    <v-select
      :items="priorities"
      item-text="text"
      item-value="value"
      :value="ticketPriority"
      @change="updateTicketsPriority($event)"
      persistent-hint
      filled
      rounded
      dense
      hint="Change ticket's Priority"
      single-line
      style="max-width: 200px"
    ></v-select>
    <v-menu
      ref="menu"
      v-model="menu"
      :close-on-content-click="false"
      transition="scale-transition"
      offset-y
      min-width="auto"
    >
      <template v-slot:activator="{ on, attrs }">
        <v-text-field
          single-line
          style="max-width: 200px"
          persistent-hint
          filled
          rounded
          dense
          :value="updatedDate"
          hint="Deadline"
          readonly
          v-bind="attrs"
          v-on="on"
        ></v-text-field>
      </template>
      <v-date-picker v-model="date" no-title scrollable>
        <v-spacer></v-spacer>
        <v-btn text color="primary" @click="menu = false"> Cancel </v-btn>
        <v-btn text color="primary" @click="updateDeadline(date)"> OK </v-btn>
      </v-date-picker>
    </v-menu>
  </div>
</template>
<script>
import getDepts from "../mixins/getDepts";
import priorities from "../mixins/priorities";
export default {
  props: {
    deptUsers: {
      type: Array,
      required: true,
    },
    ticketDept: {
      type: Number,
      required: true,
    },
    ticketId: {
      type: Number,
      required: true,
    },
    ticketPriority: {
      type: Number,
      required: true,
    },
    ticketDeadline: {
      type: String,
      required: true,
    },
    ticketAssignees: {
      type: Array,
      required: true,
    },
    getTicket: {
      type: Function,
      required: true,
    },
  },
  mixins: [getDepts, priorities],
  data() {
    return {
      menu: false,
      depts: [],
      date: null,
    };
  },
  computed: {
    updatedDate() {
      return this.date || this.ticketDeadline;
    },
  },
  methods: {
    async assignUserToTicket(assignees) {
      console.log(assignees, 'assign');
      await axios.patch(`/api/ticketupdate/${this.ticketId}`, {
        assignees: JSON.stringify(assignees),
      });
    },
    async changeTicketDept(dept_id) {
      await axios.patch(`/api/ticketupdate/${this.ticketId}`, {
        dept_id,
      });
      setTimeout(async () => {
        await this.getTicket(this.ticketId);
      }, 2000);
    },
    async updateTicketsPriority(priority) {
      await axios.patch(`/api/ticketupdate/${this.ticketId}`, {
        priority,
      });
      setTimeout(async () => {
        await this.getTicket(this.ticketId);
      }, 2000);
    },
    async updateDeadline(date) {
      await axios.patch(`/api/ticketupdate/${this.ticketId}`, {
        deadline: date,
      });
      this.menu = false;
      await this.getTicket(this.ticketId);
      this.date = null;
    },
  },
  async beforeMount() {
    await this.getDepts();
  },
};
</script>