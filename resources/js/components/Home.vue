<template>
  <div class="">
      <app-nav></app-nav>
       <v-main>
        <v-container
          class="fill-height"
          fluid>
          <v-row
            align="center"
            justify="center"
          >
            <v-col class="text-center">
             HomePage
            </v-col>
          </v-row>
        </v-container>
        <app-footer></app-footer>
      </v-main>
  </div>
</template>

<script>
export default {
    name:'app-home',
    data(){
        return {
            on: true,
        }
    }

}
</script>

<style>

</style>
