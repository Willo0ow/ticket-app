<template>
    <v-list v-if="tickets.length">
        <v-list-item v-for="ticket of tickets" :key="ticket.id">
            <v-card width="100%" class="my-3">
                <v-card-title>{{ ticket.title }}</v-card-title>
                <v-card-text>{{ ticket.content }}</v-card-text>
                <v-card-actions>
                    <v-btn small class="ml-auto" @click="actionOne(ticket.id)">{{actionOneTitle}}</v-btn>
                </v-card-actions>
            </v-card>
        </v-list-item>
    </v-list>
</template>
<script>
export default {
    props: {
        tickets: { type: Array, required: true },
        actionOne: { type: Function, required: true },
        actionOneTitle: { type: String, required: true }
    }
};
</script>
