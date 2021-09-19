<template>
  <request-list
    :requests="requests"
    :actionOne="accept"
    actionOneTitle="Accept"
    :disabled="isAccepted"
    :actionTwo="reject"
    actionTwoTitle="Reject"
  ></request-list>
</template>
<script>
import { mapState, mapActions } from "vuex";
import RequestList from "../components/RequestList.vue";

export default {
  components: { RequestList },
  data() {
    return {
      requests: [],
    };
  },
  computed: {
    ...mapState({
      userDept: (state) =>
        state.authUser ? state.authUser.department_id : null,
    }),
  },
  methods: {
    ...mapActions(["getUserInfo"]),
    async getRequests() {
      if (!this.userDept) {
        await this.getUserInfo();
      }
      const { data } = await axios.get(
        `/api/deptassignmentrequest/${this.userDept}`
      );
      this.requests = data;
    },
    async accept(id) {
      const request = this.requests.find((request) => request.id === id);
      const assignees = JSON.parse(request.assignees);
      const updatedAssignees = assignees.includes(request.request_user_id)
        ? assignees
        : [...assignees, request.request_user_id];
      await axios.patch(`/api/ticketupdate/${request.ticket_id}`, {
        assignees: JSON.stringify(updatedAssignees),
      });
      await axios.patch(`/api/assignmentrequest/${id}`, { status: 1 });
      await this.getRequests();
    },
    async reject(id) {
      await axios.patch(`/api/assignmentrequest/${id}`, { status: 2 });
      await this.getRequests();
    },
    isAccepted(request) {
      return request.status > 0;
    },
  },
  async beforeMount() {
    await this.getRequests();
  },
};
</script>