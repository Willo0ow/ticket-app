
<template>
  <v-list v-if="items.length" dense>
    <v-list-item v-for="(item, index) of items" :key="index">
      <v-card width="100%" class="my-3">
        <v-card-title>{{ item.name }}</v-card-title>
        <v-card-subtitle>{{ item.supervisor }}</v-card-subtitle>
        <v-card-text></v-card-text>
        <v-card-actions>
          <v-btn text small @click="editDept(item.id)">
            <v-icon color="red">{{ editIcon }}</v-icon>
          </v-btn>
          <v-text-field
            v-if="selectedItem === item.id"
            :value="item.name"
            required
            single-line
            style="max-width: 200px"
            persistent-hint
            filled
            rounded
            dense
            hint="Name"
            @change="updateDeptProperty({ value: $event, property: 'name' })"
          ></v-text-field>
          <v-select
            v-if="selectedItem === item.id"
            :items="users"
            item-text="name"
            item-value="id"
            :value="item.supervisor_id"
            persistent-hint
            filled
            rounded
            dense
            hint="Choose the supervisor"
            single-line
            style="max-width: 200px"
            @input="
              updateDeptProperty({ value: $event, property: 'supervisor_id' })
            "
          ></v-select>
        </v-card-actions>
      </v-card>
    </v-list-item>
  </v-list>
</template>
<script>
import getDepts from "../mixins/getDepts";
import { mdiCircleEditOutline } from "@mdi/js";

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
      depts: [],
      selectedItem: null,
    };
  },
  methods: {
    editDept(id) {
      this.selectedItem = id;
    },
    async updateDeptProperty({ value, property }) {
      await axios.patch(`/api/department/${this.selectedItem}`, {
        [property]: value,
      });
      await this.getItems();
      this.selectedItem = null;
    },
  },
};
</script>
