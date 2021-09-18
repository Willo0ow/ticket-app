<template>
  <v-form>
    <v-text-field
      v-model="name"
      label="Name"
      required
    ></v-text-field>
    <v-select
      label="Choose the supervisor"
      :items="users"
      item-text="name"
      item-value="id"
      v-model="supervisor_id"
    ></v-select>
    <v-btn @click="saveDepartment">Save</v-btn>
    <v-btn @click="cancel">Cancel</v-btn>
  </v-form>
</template>
<script>
export default {
  data() {
    return {
      name: "",
      supervisor_id: null,
      users: [],
    };
  },
  methods: {
    async getUsers() {
      const { data } = await axios.get("/api/users");
      this.users = data;
    },
    async saveDepartment() {
      await axios.post("/api/department", {
        name: this.name,
        supervisor_id: this.supervisor_id,
      });
    },
    cancel(){
        this.name = "";
        this.supervisor_id= "";
    }
  },
  async mounted() {
    await this.getUsers();
  },
};
</script>