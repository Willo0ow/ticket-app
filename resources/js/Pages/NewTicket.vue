<template>
    <v-sheet>
            <v-card-title>Add New Ticket</v-card-title>
            <v-card-text>
                <v-select label="Department" v-model="dept_id" :items="depts" item-value="id" item-text="name"></v-select>
                <v-text-field v-model="title" label="Title"></v-text-field>
                <v-textarea v-model="content" label="Content"></v-textarea>
                <div class="d-flex justify-space-between">

                <v-menu
                    ref="menu"
                    v-model="menu"
                    :close-on-content-click="false"
                    :return-value.sync="deadline"
                    transition="scale-transition"
                    offset-y
                    min-width="auto"
                >
                    <template v-slot:activator="{ on, attrs }">
                        <v-text-field
                            v-model="deadline"
                            label="Deadline"
                            readonly
                            v-bind="attrs"
                            v-on="on"
                        ></v-text-field>
                    </template>
                    <v-date-picker v-model="deadline" no-title scrollable>
                        <v-spacer></v-spacer>
                        <v-btn text color="primary" @click="menu = false">
                            Cancel
                        </v-btn>
                        <v-btn
                            text
                            color="primary"
                            @click="$refs.menu.save(date)"
                        >
                            OK
                        </v-btn>
                    </v-date-picker>
                </v-menu>
                <v-spacer></v-spacer>
                <v-select
                    v-model="priority"
                    :items="priorities"
                    item-text="text"
                    item-value="value"
                    label="Priority"
                ></v-select>
                </div>
            </v-card-text>
            <v-card-actions>
                <v-btn class="ml-auto" @click="cancel">Cancel</v-btn>
                <v-btn color="primary" @click="saveNewTicket">Save</v-btn>
            </v-card-actions>
    </v-sheet>
</template>
<script>
import getDepts from "../mixins/getDepts";

export default {
    mixins: [getDepts],
    name: "NewTicket",
    data() {
        return {
            dept_id: null,
            title: "",
            content: "",
            deadline: new Date().toISOString().slice(0, 10),
            priority: 1,
            priorities: [
                { text: "Low", value: 1 },
                { text: "Medium", value: 2 },
                { text: "High", value: 3 },
                { text: "Super High", value: 4 }
            ],
            menu: false,
            depts: [],
        };
    },
    methods: {
        async saveNewTicket() {
            const form = {
                title: this.title,
                content: this.content,
                deadline: this.deadline,
                priority: this.priority,
                dept_id: this.dept_id,
            };
            await axios.post("/ticket", form);
            setTimeout(()=>{
                this.cancel()
            }, 2000)
        },
        cancel() {
            this.dept_id = null;
            this.title = "";
            this.content = "";
            this.deadline = new Date().toISOString().slice(0, 10);
            this.priority = 1;
        }
    },
    async created(){
        await this.getDepts()
    }
};
</script>
