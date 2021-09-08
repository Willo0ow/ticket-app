<template>
  <v-app>
      <navigation />
    <v-main>
      <div class="container">
        <router-view />
      </div>
    </v-main>
  </v-app>
</template>
<script>
import Navigation from "./components/Navigation.vue";

export default {
    components: {Navigation},
    name: "App",
    async created(){
        await this.$store.dispatch('getUserInfo');
    }
}
</script>
