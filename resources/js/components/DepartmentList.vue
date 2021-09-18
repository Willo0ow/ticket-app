<template>
  <v-list dense>
    <v-list-item v-for="(item, index) of items" :key="index">
      <v-list-item-content>
        <v-list-item-title>{{index + 1}}. {{ getTitle(item) }}</v-list-item-title>
      </v-list-item-content>
      <v-list-item-action>
        <v-icon @click="action(item.id)">{{icon}}</v-icon>
      </v-list-item-action>
    </v-list-item>
  </v-list>
</template>
<script>
export default {
  name: "DepartmentList",
  props: {
    icon: {
      type: String,
      required: false,
    },
    action: {
      type: Function,
      required: false
    },
    items: {
      type: Array,
      required: true,
    },
    titleDetails: {
      type: Array,
      required: true
    }
  },
methods:{
  getTitle(item){
    return this.titleDetails.reduce((title, detail)=>{
      return `${title} ${item[detail]}`
    }, "")
  }
}
};
</script>