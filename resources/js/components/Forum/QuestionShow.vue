<template>
  <v-row no-gutters class="question">
    <v-col cols="12">
      <v-card color="#385F73" dark v-if="question">
        <v-card-title class="headline">
          <div>{{ question.title }}</div>
          <v-spacer></v-spacer>
          <div>{{ replyCount }} Replies</div>
        </v-card-title>
        <v-card-subtitle>
          asked by
          <strong>{{ question.user }}</strong>
          {{ question.created_at }}
        </v-card-subtitle>

        <v-card-text v-html="body"></v-card-text>
        <v-card-actions v-if="own">
          <v-btn text icon @click="edit">
            <v-icon>mdi-pencil</v-icon>
          </v-btn>
          <v-btn text color="error" @click="destroy">
            <v-icon>mdi-delete</v-icon>
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-col>
    <v-col cols="8">
        <replies v-if="question" @replyDeleted="replyCount = replyCount - 1"  :slug="question.slug" :replies="question.replies"></replies>
    </v-col>
  </v-row>
</template>

<script>
import md from "marked";
import RepliesVue from '../Reply/Replies.vue';
export default {
  data() {
    return {
      question: null,
      own: 1,
    };
  },
  components:{
      replies: RepliesVue
  },
  mounted() {
    // const url = `/api/questions/${this.$route.params.slug}`
    // console.log('route 1 is ', this.$route.params);
    // console.log('route 2 is ', url);
    // let route = '/api/questions/new-question-added-via-postman';
    // console.log('route 3 is ', route);
    axios
      .get(`/api/questions/${this.$route.params.slug}`)
      .then((res) => {
        this.question = res.data.data;
        this.own = User.own(this.question.user_id);
      })
      .catch((err) => console.log("error is occured ", err.message));
  },
  computed: {
    body() {
      return md.parse(this.question.body);
    },
    replyCount:{
        get(){
            return this.question.reply_count;
        },
        set(newReplyCount){
        }
    }
  },
  methods: {
    destroy() {
      axios
        .delete(`/api/questions/${this.$route.params.slug}`)
        .then(res => console.log('deleted successfully'))
        .catch((err) => console.log("error is occured ", err.message));
    },
    edit(){
        this.$router.push({ name: 'editSingleQuestion', params: { slug: this.$route.params.slug }});
    }
  },
};
</script>

<style scoped>
/* .question { */
  /* margin-top: 10px; */
/* } */
</style>
