<template>
  <v-card class="sidebar">
    <v-card-title>
      <v-toolbar color="cyan" dense dark>
        <v-toolbar-title>Categories</v-toolbar-title>
      </v-toolbar>
    </v-card-title>
    <v-card-text v-if="categories">
      <v-list  v-for="category in categories" :key="category.id">
        <v-list-item >
          <v-list-item-content>
            <v-list-item-title>{{ category.name }}</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-divider></v-divider>
      </v-list>
    </v-card-text>
  </v-card>
</template>

<script>
export default {
    mounted(){
        axios.get(`api/categories`)
            .then(res => this.categories = res.data.data)
            .catch(err => console.log(err))
    },
    data(){
        return{
            categories: null
        }
    }
};
</script>

<style lang="scss" scoped>
.sidebar {
  margin: 10px;
  padding: 0 !important;
}
.v-card__title{
    box-sizing: border-box;
    padding: 0 !important;
    margin-top: 6px;
}
</style>
