<template>
    <v-sheet>
        <v-card>
            <v-card-title>Add New Ticket</v-card-title>
            <v-card-text>
                <v-text-field v-model="title" label="Title"></v-text-field>
                <v-textarea v-model="content" label="Content"></v-textarea>
                <v-date-picker v-model="deadline"></v-date-picker>
                <v-select
                    v-model="priority"
                    :items="priorities"
                    item-text="text"
                    item-value="value"
                    label="Priority"
                ></v-select>
            </v-card-text>
            <v-card-actions>
                <v-btn @click="saveNewTicket">Save</v-btn>
                <v-btn @click="cancel">Cancel</v-btn>
            </v-card-actions>
        </v-card>
    </v-sheet>
</template>
<script>
export default {
    name: "NewTicket",
    data() {
        return {
            title: "",
            content: "",
            deadline: new Date().toISOString().slice(0, 10),
            priority: null,
            priorities: [
                { text: "Low", value: 1 },
                { text: "Medium", value: 2 },
                { text: "High", value: 3 },
                { text: "Super High", value: 4 }
            ]
        };
    },
    methods: {
        async saveNewTicket() {
            const form = {
                title: this.title,
                content: this.content,
                deadline: this.deadline,
                priority: this.priority
            };
            await axios.post("/ticket", form);
        },
        cancel() {
            this.title = "";
            this.content = "";
            this.deadline = new Date().toISOString().slice(0, 10);
            this.priority = 1;
        }
    }
};
</script>
