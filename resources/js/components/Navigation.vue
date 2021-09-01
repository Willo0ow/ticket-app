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
      <v-list-item  link to="/account">
        <v-list-item-content>
          <v-list-item-title class="text-subtitle2">Account</v-list-item-title>
        </v-list-item-content>
      </v-list-item>

        <v-list-group
          :value="false"
          no-action
        >
          <template v-slot:activator>
            <v-list-item-content>
              <v-list-item-title>Settings</v-list-item-title>
            </v-list-item-content>
          </template>

          <v-list-item
            v-for="({title, icon, path}, i) in settings"
            :key="i"
            link
            :to="path"
            dense
            class="pl-5"
          >
            <v-list-item-title v-text="title"></v-list-item-title>

            <v-list-item-icon>
              <v-icon v-text="icon"></v-icon>
            </v-list-item-icon>
          </v-list-item>
        </v-list-group>



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
      settings: [
        { title: "Departments", path: "/settings/depts", icon: "" },
        { title: "Users", path: "/settings/users", icon: "" },
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
