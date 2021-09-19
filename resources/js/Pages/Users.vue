<template>
    <div>
        <div>users</div>
        <v-btn @click="updateUser">Save</v-btn>
        <v-select
            v-model="selectedDept"
            :items="depts"
            item-value="id"
            item-text="name"
        ></v-select>
        <v-list>
            <v-list-item
                v-for="({ id, name, department_id }, index) of users"
                :key="id"
            >
                <v-list-item-title
                    >{{ index + 1 }}. {{ name }} -
                    {{ department_id }}</v-list-item-title
                >
                <v-list-item-action>
                    <v-btn @click="selectUser(id)">Select</v-btn>
                </v-list-item-action>
            </v-list-item>
        </v-list>
    </div>
</template>
<script>
import getDepts from "../mixins/getDepts";

export default {
    mixins: [getDepts],
    name: "Users",
    data() {
        return {
            users: [],
            depts: [],
            selectedDept: null,
            selectedUser: null
        };
    },
    methods: {
        async getUsers() {
            const { data } = await axios.get("/api/users");
            this.users = data;
        },
        selectUser(id) {
            this.selectedUser = id;
        },
        async updateUser() {
            await axios.patch(`/api/users/${this.selectedUser}`, {
                department_id: this.selectedDept
            });
        }
    },
    async mounted() {
        await this.getUsers();
        await this.getDepts();
    }
};
</script>
