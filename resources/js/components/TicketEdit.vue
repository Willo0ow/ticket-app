<template>
    <v-card>
        <v-card-title>
            {{ticket.title}}
        </v-card-title>
        <v-card-text>
            {{ticket.content}}
        </v-card-text>
        <v-card-actions>
            <slot name="actions"></slot>
            <v-btn>Test</v-btn>
        </v-card-actions>
    </v-card>
</template>
<script>
export default {
    props: {
        ticket: {type: Object, required: true}
    }
}
</script>
