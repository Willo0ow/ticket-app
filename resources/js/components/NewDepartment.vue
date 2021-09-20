<template>
  <v-form>
    <v-text-field
      v-model="name"
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
      :items="users"
      item-text="name"
      item-value="id"
      v-model="supervisor_id"
      persistent-hint
      filled
      rounded
      dense
      hint="Choose the supervisor"
      single-line
      style="max-width: 200px"
    ></v-select>
    <v-btn @click="saveDepartment">Save</v-btn>
    <v-btn @click="cancel">Cancel</v-btn>
  </v-form>
</template>
<script>
export default {
  props: {
    close: {
      type: Function,
      required: true,
    },
    getItems: {
      type: Function,
      required: true,
    },
    users: {
      type: Array,
      required: true,
    },
  },
  data() {
    return {
      name: "",
      supervisor_id: null,
      users: [],
    };
  },
  methods: {
    async saveDepartment() {
      await axios.post("/api/department", {
        name: this.name,
        supervisor_id: this.supervisor_id,
      });
      await this.getItems();
      this.cancel();
    },
    cancel() {
      this.name = "";
      this.supervisor_id = "";
      this.close();
    },
  },
};
</script>
