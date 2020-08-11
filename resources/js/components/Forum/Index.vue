<template>
  <div class="main">
    <app-nav></app-nav>
    <v-main style="margin-top: 50px;">
      <v-container fluid>
          <router-view></router-view>
      </v-container>
      <app-footer></app-footer>
    </v-main>
  </div>
</template>

<script>
export default {

};
</script>

<style lang="scss" scoped>
    .main{
        height: 100vh !important ;
        overflow-y: scroll;
    }

</style>
