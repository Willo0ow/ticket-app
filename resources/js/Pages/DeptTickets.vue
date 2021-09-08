<template>
    <v-container>
        <v-card-title>Department Tickets</v-card-title>
        <v-list v-if="tickets.length">
            <v-list-item v-for="ticket of tickets" :key="ticket.id">
                <v-card width="100%" class="my-3">
                    <v-card-title>{{ticket.title}}</v-card-title>
                    <v-card-text>{{ticket.content}}</v-card-text>
                    <v-card-actions>
                        <v-btn small class="ml-auto">Assign</v-btn>
                    </v-card-actions>
                </v-card>
            </v-list-item>
        </v-list>
    </v-container>
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
