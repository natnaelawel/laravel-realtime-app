<template>
  <v-row no-gutters class="questions">
    <v-col md="8">
      <v-row v-for="(question, i) in AllQuestions" :key="i">
        <v-col cols="12">
          <question :question="question"></question>
        </v-col>
      </v-row>
    </v-col>
    <v-col md="4" >
      <app-sidebar class="sidebar">

      </app-sidebar>
    </v-col>
  </v-row>
</template>

<script>
import Question from "./Question.vue";
import AppSidebar from './AppSidebar.vue';
export default {
  mounted() {
    axios
      .get("api/questions")
      .then((res) => {
        this.questions = res.data.data;
      })
      .catch((err) => console.log(err.message));
  },
  computed: {
    AllQuestions() {
      return this.questions;
    },
  },
  data() {
    return {
      on: true,
      questions: [],
    };
  },
  components: {
    question: Question,
    appSidebar: AppSidebar,
  },
};
</script>

<style lang="scss" scoped>
    // .questions{

    // }
    // .sidebar{
    //     margin: 6px;;
    //     // position: fixed !important;
    //     // float: right;
    // }
</style>
