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
      v-model="assignedUser"
      @change="assignUserToTicket($event)"
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
  </div>
</template>
<script>
import getDepts from "../mixins/getDepts";
export default {
    props: {
        deptUsers: {
            type: Array,
            required: true
        },
        ticketDept: {
            type: Number,
            required: true,
        },
        ticketId: {
            type: Number,
            required: true,
        }
    },
  mixins: [getDepts],
  data() {
    return {
      depts: [],
      assignedUser: null,
    };
  },
  methods: {
    async assignUserToTicket(assignedUser) {
      await axios.patch(`/api/ticketupdate/${this.ticketId}`, {
        assignees: JSON.stringify([assignedUser]),
      });
    },
    async changeTicketDept(dept_id) {
      await axios.patch(`/api/ticketupdate/${this.ticketId}`, {
        dept_id,
      });
      setTimeout(async () => {
        await this.getDeptTickets();
      }, 2000);
    },
  },
  async beforeMount(){
      await this.getDepts()
  }
};
</script>