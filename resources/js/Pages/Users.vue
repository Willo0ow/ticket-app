<template>
  <div>
    <div>users</div>
    <v-list v-if="users.length" dense>
      <v-list-item
        v-for="{ id, name, department, department_id } of users"
        :key="id"
      >
        <v-card width="100%" class="my-3">
          <v-card-title>{{ name }}</v-card-title>
          <v-card-subtitle>{{ department }}</v-card-subtitle>
          <v-card-text></v-card-text>
          <v-card-actions>
            <v-btn text small @click="editUser(id)">
              <v-icon color="red">{{ editIcon }}</v-icon>
            </v-btn>
            <v-text-field
              v-if="selectedUser === id"
              :value="name"
              required
              single-line
              style="max-width: 200px"
              persistent-hint
              filled
              rounded
              dense
              hint="Name"
              @change="updateUser({ value: $event, property: 'name' })"
            ></v-text-field>
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
              single-line
              style="max-width: 200px"
              @input="updateUser({ value: $event, property: 'department_id' })"
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
    async updateUser({ value, property }) {
      await axios.patch(`/api/users/${this.selectedUser}`, {
        [property]: value,
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
