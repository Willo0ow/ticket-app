<template>
  <v-card>
    <v-card-title>
      {{ ticket.title }}
    </v-card-title>
    <v-card-text>
      {{ ticket.content }}
    </v-card-text>
    <v-card-actions>
      <slot name="actions"></slot>
      <v-btn @click="closeFunction">Close</v-btn>
    </v-card-actions>
<slot name="comments"></slot>
  </v-card>
</template>
<script>
export default {
  props: {
    ticket: { type: Object, required: true },
    closeFunction: { type: Function, required: true },
  },
};
</script>
