<template>
  <div>
    <div>Depratments</div>
    <v-btn @click="showDeptForm">New</v-btn>
    <new-department v-if="isDeptFormVisible" :close="closeDeptForm" :getItems="getDepts"></new-department>
    <department-list
      v-if="!isDeptFormVisible"
      :action="editDepartment"
      :items="depts"
    ></department-list>
  </div>
</template>
<script>
import DepartmentList from "../components/DepartmentList.vue";
import NewDepartment from "../components/NewDepartment.vue";
import getDepts from "../mixins/getDepts"

export default {
  components: { NewDepartment, DepartmentList },
  name: "Depratments",
  mixins: [getDepts],
  data() {
    return {
      isDeptFormVisible: false,
      depts: [],
      deptDetails: ["name", "supervisor"],
    };
  },
  methods: {
    showDeptForm() {
      this.isDeptFormVisible = true;
    },
    closeDeptForm() {
      this.isDeptFormVisible = false;
    },
    editDepartment(id) {},
  },
  async beforeMount() {
    await this.getDepts();
  },
};
</script>