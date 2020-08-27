<template>
  <v-row no-gutters class="questions">
    <v-col md="8">
      <v-row v-for="(question, i) in AllQuestions" :key="i">
        <v-col cols="12">
          <question :question="question"></question>
        </v-col>
        <v-col cols="6" offset="3"></v-col>
      </v-row>
      <v-pagination
        v-model="pagination_meta.current_page"
        :length="pagination_meta.total"
        prev-icon="mdi-menu-left"
        next-icon="mdi-menu-right"
        :total-visible="7"
        @input="paginate"
        circle
      ></v-pagination>
    </v-col>
    <v-col md="4">
      <app-sidebar class="sidebar"></app-sidebar>
    </v-col>
  </v-row>
</template>

<script>
import Question from "./Question.vue";
import AppSidebar from "./AppSidebar.vue";
export default {
  mounted() {
   this.fetchData()
  },
  computed: {
    AllQuestions() {
      return this.questions;
    },
  },
  methods: {
    paginate(page) {
      this.fetchData(page);
    },
    fetchData(page = false) {
      const url = page ? `/api/questions?page=${page}` : "api/questions";
      axios
        .get(url)
        .then((res) => {
          this.questions = res.data.data;
          this.pagination_meta = res.data.meta;
          this.pagination_links = res.data.links;
        })
        .catch((err) => console.log(err.message));
    },
  },
  data() {
    return {
      on: true,
      questions: [],
      page: 1,
      pagination_meta: {},
      pagination_links: {},
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
