<template>
    <div>DeptTickets</div>
</template>
<script>
import { mapState, mapActions } from "vuex";
export default {
    name: "DeptTickets",
    data() {
        return {
            tickets: []
        };
    },
    computed: {
        ...mapState({
            userDept: state => state.authUser? state.authUser.department_id : null
        })
    },
    methods: {
        ...mapActions(["getUserInfo"]),
        async getDeptTickets() {
            if (!this.userDept) {
                await this.getUserInfo();
            }
            const { data } = await axios.get(
                `/api/depttickets/${this.userDept}`
            );
            this.tickets = data;
        }
    },
    async beforeMount() {
        await this.getDeptTickets();
    }
};
</script>
