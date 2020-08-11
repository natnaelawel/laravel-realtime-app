<template>
  <v-card color="#385F73" dark>
    <v-card-title class="headline" >
        <router-link class="title"  :to="{ name: 'showSingleQuestion', params: { slug: questionLink() }}">
            {{ question.title }}
        </router-link>
    </v-card-title>

    <v-card-subtitle>asked by <strong> {{ question.user }} </strong>  {{ question.created_at }}</v-card-subtitle>
    <v-card-text>{{question.body}}
    </v-card-text>
    <v-card-actions>
      <v-btn text>
        <v-icon>mdi-thumb-up-outline</v-icon>
      </v-btn>
       <v-btn text>
        <v-icon>mdi-thumb-down-outline</v-icon>
      </v-btn>
        <v-btn text>
        <v-icon>mdi-share-outline</v-icon>
      </v-btn>
    </v-card-actions>
  </v-card>
</template>

<script>
export default {
    props:{
        question:{
            type: Object
        }
    },
    methods:{
        questionLink(){
            const slug = this.question.title.toLocaleLowerCase().replace(/ /g, "-").replace(".", "");
            return slug;
        }
    }
};
</script>

<style lang="scss" scoped>
    .title{
        color: white;
        
    }
</style>
