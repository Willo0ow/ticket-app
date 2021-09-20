<template>
  <div>
    <div>Depratments</div>
    <v-btn @click="showDeptForm">New</v-btn>
    <new-department
      v-if="isDeptFormVisible"
      :close="closeDeptForm"
      :getItems="getDepts"
      :users="users"
    ></new-department>
    <department-list v-if="!isDeptFormVisible" :items="depts" :users="users" :getItems="getDepts"></department-list>
  </div>
</template>
<script>
import DepartmentList from "../components/DepartmentList.vue";
import NewDepartment from "../components/NewDepartment.vue";
import getDepts from "../mixins/getDepts";

export default {
  components: { NewDepartment, DepartmentList },
  name: "Depratments",
  mixins: [getDepts],
  data() {
    return {
      isDeptFormVisible: false,
      depts: [],
      deptDetails: ["name", "supervisor"],
      users: [],
    };
  },
  methods: {
    async getUsers() {
      const { data } = await axios.get("/api/users");
      this.users = data;
    },
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
    await this.getUsers();
  },
};
</script>