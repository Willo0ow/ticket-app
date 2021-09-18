<template>
  <v-list v-if="requests.length">
    <v-list-item v-for="request of requests" :key="request.id">
      <v-card width="100%" class="my-3">
        <v-card-title>{{ request.title }}</v-card-title>
        <v-card-text>
          <div>{{ request.request_user }}</div>
          <div>{{ request.message }}</div>
          <div>{{ request.title }}</div>
          <div>{{ request.content }}</div>
          <div v-if="request.status === 1">Accepted</div>
          <div v-else-if="request.status === 2">Rejected</div>
          <div v-else>Not Accepted</div>
        </v-card-text>
        <v-card-actions>
          <v-btn small class="ml-auto" :disabled="disabled(request)" @click="actionOne(request.id)">{{
            actionOneTitle
          }}</v-btn>
          <v-btn small class="ml-auto" :disabled="disabled(request)" @click="actionTwo(request.id)">{{
            actionTwoTitle
          }}</v-btn>
        </v-card-actions>
      </v-card>
    </v-list-item>
  </v-list>
</template>
<script>
export default {
  props: {
    requests: { type: Array, required: true },
    actionOne: { type: Function, required: true },
    actionOneTitle: { type: String, required: true },
    actionTwo: { type: Function, required: true },
    actionTwoTitle: { type: String, required: true },
    disabled: {type: Function, required: true}
  },
};
</script>
