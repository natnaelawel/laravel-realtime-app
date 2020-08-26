<template>
  <v-app>
    <app-nav></app-nav>
    <v-main class="main" fluid>
      <v-container>
        <router-view></router-view>
      </v-container>
      <app-footer></app-footer>
    </v-main>
  </v-app>
</template>

<script>
export default {
  name: "app-index",
  created() {},
  data() {
    return {};
  },
};
</script>

<style lang="scss" scoped>
.main {
  margin-top: 50px;
  height: 100vh !important ;
  overflow-y: scroll;
}
</style>
