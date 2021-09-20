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
            <v-btn text small @click="editUser({name, department_id, id})">
              <v-icon color="red">{{ editIcon }}</v-icon>
            </v-btn>
            <v-text-field
              v-if="selectedUser === id"
              v-model="name_edit"
              required
              single-line
              style="max-width: 200px"
              persistent-hint
              filled
              rounded
              dense
              hint="Name"
            ></v-text-field>
            <v-select
              v-if="selectedUser === id"
              v-model="department_id_edit"
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
            ></v-select>
            <v-btn v-if="selectedUser === id" small text @click="updateUser">
              <v-icon>{{saveIcon}}</v-icon>
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-list-item>
    </v-list>
  </div>
</template>
<script>
import getDepts from "../mixins/getDepts";
import { mdiCircleEditOutline } from "@mdi/js";
import { mdiContentSaveOutline } from "@mdi/js";

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
      saveIcon: mdiContentSaveOutline,
      name_edit: "",
      department_id_edit: null,
    };
  },
  methods: {
    async getUsers() {
      const { data } = await axios.get("/api/users");
      this.users = data;
    },
    editUser({name, department_id, id}) {
      if(this.selectedUser === id){
        this.selectedUser = null;
        this.name_edit = "";
        this.department_id_edit = null;
      } else {
        this.name_edit = name;
        this.department_id_edit = department_id;
        this.selectedUser = id;
      }
    },
    async updateUser() {
      await axios.patch(`/api/users/${this.selectedUser}`, {
        name: this.name_edit,
        department_id: this.department_id_edit,
      });
      this.selectedUser = null;
      this.name_edit = "";
      this.department_id_edit = null;
      await this.getUsers();
    },
  },
  async mounted() {
    await this.getUsers();
    await this.getDepts();
  },
};
</script>
