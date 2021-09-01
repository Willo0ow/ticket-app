<template>
  <v-navigation-drawer app dark width="200" permanent>
    <v-list>
      <v-list-item link to="/home">
        <v-list-item-content>
          <v-list-item-title class="text-button"
            >Company Tickets</v-list-item-title
          >
        </v-list-item-content>
      </v-list-item>
      <v-divider></v-divider>
      <v-list-item v-for="uLink of userLinks" :key="uLink.text" link :to="uLink.link">
        <v-list-item-content>
          <v-list-item-title class="text-subtitle2">{{
            uLink.text
          }}</v-list-item-title>
        </v-list-item-content>
      </v-list-item>
      <v-divider></v-divider>
      <v-list-item v-for="tLink of ticketLinks" :key="tLink.text" link :to="tLink.link">
        <v-list-item-content>
          <v-list-item-title class="text-subtitle2">{{
            tLink.text
          }}</v-list-item-title>
        </v-list-item-content>
      </v-list-item>
      <v-divider></v-divider>
      <v-list-item link to="/reports">
        <v-list-item-content>
          <v-list-item-title class="text-subtitle2">Reports</v-list-item-title>
        </v-list-item-content>
      </v-list-item>
    </v-list>
  </v-navigation-drawer>
</template>

<script>
export default {
  name: "navigation",
  data() {
    return {
      userLinks: [
        { text: "Account", link: "/account" },
        { text: "Settings", link: "/settings" },
      ],
      ticketLinks: [
        { text: "New Ticket", link: "/tickets/new" },
        { text: "My tickets", link: "/tickets/user" },
        { text: "Department Tickets", link: "/tickets/dept" },
      ],
    };
  },
};
</script>
