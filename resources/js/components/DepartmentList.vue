
<template>
  <v-list v-if="items.length" dense>
    <v-list-item v-for="({name, supervisor_id, supervisor, id}, index) of items" :key="index">
      <v-card width="100%" class="my-3">
        <v-card-title>{{ name }}</v-card-title>
        <v-card-subtitle>{{ supervisor }}</v-card-subtitle>
        <v-card-text></v-card-text>
        <v-card-actions>
          <v-btn text small @click="editDept({name, supervisor_id, id})">
            <v-icon color="red">{{ editIcon }}</v-icon>
          </v-btn>
          <v-text-field
            v-if="selectedItem === id"
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
            v-if="selectedItem === id"
            :items="users"
            item-text="name"
            item-value="id"
            v-model="supervisor_id_edit"
            persistent-hint
            filled
            rounded
            dense
            hint="Choose the supervisor"
            single-line
            style="max-width: 200px"
          ></v-select>
            <v-btn v-if="selectedItem === id" small text @click="updateDept">
              <v-icon>{{saveIcon}}</v-icon>
            </v-btn>
        </v-card-actions>
      </v-card>
    </v-list-item>
  </v-list>
</template>
<script>
import getDepts from "../mixins/getDepts";
import { mdiCircleEditOutline } from "@mdi/js";
import { mdiContentSaveOutline } from "@mdi/js";

export default {
  name: "DepartmentList",
  props: {
    items: {
      type: Array,
      required: true,
    },
    users: {
      type: Array,
      required: true,
    },
    getItems: {
      type: Function,
      required: true,
    },
  },
  mixins: [getDepts],
  data() {
    return {
      editIcon: mdiCircleEditOutline,
      saveIcon: mdiContentSaveOutline,
      depts: [],
      selectedItem: null,
      name_edit: "",
      supervisor_id_edit: null,
    };
  },
  methods: {
    editDept({supervisor_id, name, id}) {
      if(this.selectedItem === id){
        this.selectedItem = null;
        this.name_edit = "";
        this.supervisor_id_edit = null
      }else {
        this.selectedItem = id;
        this.name_edit = name;
        this.supervisor_id_edit = supervisor_id;
      }
    },
    async updateDept() {
      await axios.patch(`/api/department/${this.selectedItem}`, {
        name: this.name_edit,
        supervisor_id: this.supervisor_id_edit,
      });
      await this.getItems();
        this.selectedItem = null;
        this.name_edit = "";
        this.supervisor_id_edit = null
    },
  },
};
</script>
