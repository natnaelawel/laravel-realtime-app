<template>
  <v-container>
    <v-card class="ma-1">
      <v-card-title>
        <div class="headline">replied by {{ reply.user }}</div>
        <v-spacer></v-spacer>
        <span>{{ reply.created_at}}</span>
      </v-card-title>
      <v-divider></v-divider>
      <v-card-text class="my-4" v-html="reply.reply"></v-card-text>
      <v-card-actions>
        <template v-if="!own">
          <likes
            :replyId="reply.id"
            :LikeCount="likedCount"
            :DislikeCount="dislikedCount"
            :Liked="isLiked"
            :Disliked="isDisliked"
          ></likes>
        </template>
        <v-spacer></v-spacer>
        <template v-if="own">
          <v-btn icon>
            <v-icon color="warning" @click="editDialog= true">mdi-pencil</v-icon>
          </v-btn>
          <v-btn icon>
            <v-icon color="red" @click="destroy">mdi-delete</v-icon>
          </v-btn>
        </template>
      </v-card-actions>
    </v-card>
    <v-dialog v-if="reply" v-model="editDialog" persistent max-width="290">
      <v-card>
        <v-form @submit.prevent="editReply">
          <v-card-title class="headline">Edit Reply</v-card-title>
          <v-card-text>
            <v-row>
              <v-col cols>
                <v-text-field
                  v-model="replyContent"
                  :value="replyContent"
                  :error-messages="replyErrors"
                  label="Reply"
                  required
                  @blur="$v.reply.$touch()"
                ></v-text-field>
              </v-col>
            </v-row>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="green darken-1" text type="submit">Update</v-btn>
            <v-btn color="green darken-1" text @click="editDialog = false">Cancel</v-btn>
          </v-card-actions>
        </v-form>
      </v-card>
    </v-dialog>
  </v-container>
</template>

<script>
import { validationMixin } from "vuelidate";
import { required, maxLength } from "vuelidate/lib/validators";
import LikeVue from "../Like/Like.vue";
import DisLikeVue from "../Like/DisLike.vue";
export default {
  mixins: [validationMixin],
  validations: {
    reply: { required },
  },
  props: ["reply", "replyIndex"],
  mounted() {},
  data() {
    return {
      editDialog: false,
      replyContent: this.reply.reply,
      Liked: this.checkLiked(this.reply.like_status),
      Disliked: this.checkDisliked(this.reply.like_status),
      LikedCount: this.reply.liked_count,
      DislikedCount: this.reply.disliked_count,
    };
  },
  computed: {
    own() {
      return User.own(this.reply.user_id);
    },
    replyErrors() {
      const errors = [];
      if (!this.$v.reply.$dirty) return errors;
      !this.$v.reply.required && errors.push("reply is required");
      return errors;
    },
    isDisliked: {
      get() {
        return this.Disliked;
      },
      set(value) {
        this.Disliked = value;
      },
    },
    isLiked: {
      get() {
        return this.Liked;
      },
      set(value) {
        this.Liked = value;
      },
    },
    dislikedCount: {
      get() {
        return this.DislikedCount;
      },
      set(value) {
        this.DislikedCount = value;
      },
    },
    likedCount: {
      get() {
        return this.LikedCount;
      },
      set(value) {
        this.LikedCount = value;
      },
    },
  },
  methods: {
    destroy() {
      axios
        .delete(`/api/questions/${this.reply.slug}/replies/${this.reply.id}`)
        .then((res) => this.$emit("replyDeleted", this.replyIndex))
        .catch((err) => console.log(err));
    },
    editReply() {
      axios
        .put(`/api/questions/${this.reply.slug}/replies/${this.reply.id}`, {
          body: this.replyContent,
        })
        .then((res) => {
          this.editDialog = false;
          this.$emit("replyUpdated", {
            index: this.replyIndex,
            updatedReply: res.data,
          });
        })
        .catch((err) => console.log(err));
    },
    checkLiked(value){
        switch(value){
            case "1":
                return true;
            case "0":
                return false;

            default : return false
        }
    },
     checkDisliked(value){
        switch(value){
            case "-1":
                return true;
            case "0":
                return false;
            default : return false
        }
    }
  },
  components: {
    Likes: LikeVue,
    Dislikes: DisLikeVue,
  },
};
</script>

<style>
</style>
