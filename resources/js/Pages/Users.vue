<template>
  <div>
    <div>users</div>
    <v-list v-if="users.length" dense>
      <v-list-item v-for="{ id, name, department, department_id } of users" :key="id">
        <v-card width="100%" class="my-3">
          <v-card-title>{{ name }}</v-card-title>
          <v-card-subtitle>{{ department }}</v-card-subtitle>
          <v-card-text></v-card-text>
          <v-card-actions>
            <v-btn text small @click="editUser(id)">
              <v-icon color="red">{{ editIcon }}</v-icon>
            </v-btn>
            <v-select
            v-if="selectedUser === id"
              :value="department_id"
              :items="depts"
              item-value="id"
              item-text="name"
              persistent-hint
              filled
              rounded
              dense
              hint="Department"
              @input="
                updateUser({department_id: $event, user_id: id})
              "
              single-line
              style="max-width: 200px"
            ></v-select>
          </v-card-actions>
        </v-card>
      </v-list-item>
    </v-list>
  </div>
</template>
<script>
import getDepts from "../mixins/getDepts";
import { mdiCircleEditOutline } from "@mdi/js";

export default {
  mixins: [getDepts],
  name: "Users",
  data() {
    return {
      users: [],
      depts: [],
      selectedDept: null,
      selectedUser: null,
      editIcon: mdiCircleEditOutline,
    };
  },
  methods: {
    async getUsers() {
      const { data } = await axios.get("/api/users");
      this.users = data;
    },
    editUser(id) {
      this.selectedUser = id;
    },
    async updateUser({department_id, user_id}) {
      await axios.patch(`/api/users/${user_id}`, {
        department_id,
      });
      this.selectedUser = null;
      await this.getUsers();
    },
  },
  async mounted() {
    await this.getUsers();
    await this.getDepts();
  },
};
</script>
