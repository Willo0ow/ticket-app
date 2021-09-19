export default {
  methods: {
    async updateTicketProperty({ value, property }) {
      const form = {
        [property]: value,
      };
      if (property === "assignees") {
        form[property] = JSON.stringify(value);
      }
      await axios.patch(`/api/ticketupdate/${this.ticketId}`, form);
      setTimeout(async () => {
        await this.getTicket(this.ticketId);
        if (property === "deadline") {
          this.menu = false;
          this.date = null;
        }
      }, 2000);
    },
  },
};