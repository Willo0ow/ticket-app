
<template>
  <v-list v-if="items.length" dense>
    <v-list-item v-for="(item, index) of items" :key="index">
      <v-card width="100%" class="my-3">
        <v-card-title>{{ item.name }}</v-card-title>
        <v-card-subtitle>{{ item.supervisor }}</v-card-subtitle>
        <v-card-text></v-card-text>
        <v-card-actions>
          <v-btn text small @click="action(item.id)">
            <v-icon color="red">{{ editIcon }}</v-icon>
          </v-btn>
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
    action: {
      type: Function,
      required: false,
    },
    items: {
      type: Array,
      required: true,
    },
  },
  mixins: [getDepts],
  data() {
    return {
      editIcon: mdiCircleEditOutline,
      depts: [],
    };
  },
};
</script>
