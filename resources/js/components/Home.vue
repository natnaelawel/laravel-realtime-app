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
              <v-tooltip left>
                <template v-slot:activator="{ on }">
                  <v-btn
                    :href="source"
                    icon
                    large
                    target="_blank"
                    v-on="on"
                  >
                    <v-icon large>mdi-code-tags</v-icon>
                  </v-btn>
                </template>
                <span>Source</span>
              </v-tooltip>
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

}
</script>

<style>

</style>