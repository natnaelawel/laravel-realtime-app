<template>
  <v-app>
    <app-nav></app-nav>
    <v-main class="main" :style="'margin-top:'+ toolbarSize()" fluid>
      <router-view></router-view>
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
  methods: {
    toolbarSize() {
      switch (this.$vuetify.breakpoint.name) {
        case "xs":
        case "sm":
          return "56px";
        case "md":
          return "64px";
        case "lg":
          return "64px";
        case "xl":
          return "70px";
        default:
          return "64px";
      }
    },
  },
};
</script>

<style lang="scss" scoped>
.main {
  height: 100vh !important ;
  overflow-y: scroll;
}
</style>
