<template>
  <v-parallax height="700" dark src="/img/question-mark-1.jpg">
    <v-row align="center" justify="center">
      <v-col class="text-center" cols="12">
        <h1 class="display-4 font-weight-bold mb-4">SPA forum app</h1>
        <h4 class="headline">A Realtime Single Page forum</h4>
      </v-col>
    </v-row>
  </v-parallax>
</template>

<script>
import AB from "./check/AB";
export default {
  name: "app-home",
  created() {
      console.log('user logged in ', User.loggedIn())
  },
  data() {
    return {
      isLogged: true,
    };
  },
  components: {
    abComponent: AB,
  },
};
</script>

<style lang="scss" scoped>
</style>
