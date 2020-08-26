<template>
  <div>
    <h1>Home Page</h1>
    <ab-component></ab-component>
  </div>
</template>

<script>
import AB from "./check/AB";
export default {
  name: "app-home",
  created() {},
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
