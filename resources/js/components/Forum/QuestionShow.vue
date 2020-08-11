<template>
  <v-row no-gutters class="question" mt-5>
        <v-col cols="12">
          <v-card color="#385F73"  dark>
            <v-card-title class="headline">
                <div>
                    {{ question.title }}
                </div>
                <v-spacer></v-spacer>
                <div>8 Replies</div>
            </v-card-title>
            <v-card-subtitle>
              asked by
              <strong>{{ question.user }}</strong>
              {{ question.created_at }}
            </v-card-subtitle>

            <v-card-text v-html="question.body"></v-card-text>
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
        </v-col>
  </v-row>
</template>

<script>
export default {
  data() {
    return {
      question: {},
    };
  },
  mounted() {
    // const url = `/api/questions/${this.$route.params.slug}`
    // console.log('route 1 is ', this.$route.params);
    // console.log('route 2 is ', url);
    // let route = '/api/questions/new-question-added-via-postman';
    // console.log('route 3 is ', route);
    axios
      .get(`/api/questions/${this.$route.params.slug}`)
      .then((res) => (this.question = res.data.data))
      .catch((err) => console.log("error is occured ", err.message));
  },
};
</script>

<style scoped>
    .question{
        margin-top: 10px;
    }
</style>
