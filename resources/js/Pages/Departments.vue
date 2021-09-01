<template>
  <div>
    <div>Depratments</div>
    <v-btn @click="showDeptForm">New</v-btn>
    <v-btn @click="showDeptList">All</v-btn>
    <new-department v-if="isDeptFormVisible"></new-department>
    <department-list v-if="isDeptListVisible"></department-list>
  </div>
</template>
<script>
import DepartmentList from '../components/DepartmentList.vue';
import NewDepartment from "../components/NewDepartment.vue";

export default {
  components: { NewDepartment, DepartmentList },
  name: "Depratments",

      data() {
    return {
      isDeptFormVisible: false,
      isDeptListVisible: false,
    };
  },
  methods: {
    showDeptForm() {
      this.isDeptFormVisible = true;
      this.isDeptListVisible = false;
    },
    showDeptList() {
      this.isDeptListVisible = true;
      this.isDeptFormVisible = false;
    },
  },
};
</script>