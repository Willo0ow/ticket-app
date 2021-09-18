<template>
  <div>
    <div>Depratments</div>
    <v-btn @click="showDeptForm">New</v-btn>
    <v-btn @click="showDeptList">All</v-btn>
    <new-department v-if="isDeptFormVisible"></new-department>
    <department-list
      v-if="isDeptListVisible"
      :action="editDepartment"
      :titleDetails="deptDetails"
      :items="depts"
      :icon="editIcon"
    ></department-list>
  </div>
</template>
<script>
import DepartmentList from "../components/DepartmentList.vue";
import NewDepartment from "../components/NewDepartment.vue";
  import { mdiApplicationEditOutline } from '@mdi/js'

export default {
  components: { NewDepartment, DepartmentList },
  name: "Depratments",

  data() {
    return {
      editIcon: mdiApplicationEditOutline,
      isDeptFormVisible: false,
      isDeptListVisible: false,
      depts: [],
      deptDetails: ["name", "supervisor"],
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
    editDepartment(id) {},
    async getDepts() {
      const { data } = await axios.get("/api/departments");
      this.depts = data;
    },
  },
  async mounted() {
    await this.getDepts();
  },
};
</script>