<template>
  <v-list dense>
    <v-list-item v-for="(item, index) of depts" :key="index">
      <v-list-item-content>
        <v-list-item-title>{{index + 1}}. {{ item.name }} - {{item.supervisor}}</v-list-item-title>
      </v-list-item-content>
      <v-list-item-action>
        <v-icon @click="action(item.id)">{{ item.icon }}</v-icon>
      </v-list-item-action>
    </v-list-item>
  </v-list>
</template>
<script>
import getDepts from "../mixins/getDepts";

export default {
mixins: [getDepts],
  data() {
    return {
      depts: [],
    };
  },
  methods: {

  },
  async mounted() {
    await this.getDepts();
  },
};
</script>
