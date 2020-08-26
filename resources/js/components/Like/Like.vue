<template>
  <div>
    <template v-if="isLoggedIn">
      <v-btn text @click="like">
        <v-icon>{{ isLiked && !Disliked ? 'mdi-thumb-up': 'mdi-thumb-up-outline' }}</v-icon>
        <span style="padding: 0 10px; font-weight: bold">{{ likedCount }}</span>
      </v-btn>
      <v-btn text @click="dislike">
        <v-icon>{{ isDisliked && !Liked ? 'mdi-thumb-down': 'mdi-thumb-down-outline' }}</v-icon>
        <span style="padding: 20px; font-weight: bold">{{ dislikedCount }}</span>
      </v-btn>
    </template>
    <template v-else>
      <v-btn text>
        <v-icon>{{ isLiked && !Disliked ? 'mdi-thumb-up': 'mdi-thumb-up-outline' }}</v-icon>
        <span style="padding: 0 10px; font-weight: bold">{{ likedCount }}</span>
      </v-btn>
      <v-btn text>
        <v-icon>{{ isDisliked && !Liked ? 'mdi-thumb-down': 'mdi-thumb-down-outline' }}</v-icon>
        <span style="padding: 20px; font-weight: bold">{{ dislikedCount }}</span>
      </v-btn>
    </template>
  </div>
</template>

<script>
export default {
  props: {
    replyId: {
      type: Number,
    },
    Disliked: {
      type: Boolean,
    },
    Liked: {
      type: Boolean,
      default: false,
    },
    LikeCount: {
      type: Number,
      default: 10,
    },
    DislikeCount: {
      type: Number,
      default: 10,
    },
    isLoggedIn: {
      type: Boolean,
      default: false,
    },
  },
  created() {
    // console.log("disliked is ", this.Disliked);
    Echo.channel("likeChannel").listen("LikeEvent", (e) => {
        console.log(e)
      if (this.replyId === e.id) {
        if (e.type === "like") {
          if (e.status === 1) {
            this.likedCount++;
          } else {
            this.likedCount--;
          }
        }
        if (e.type === "dislike") {
          if (e.status === 1) {
            this.dislikedCount++;
          } else {
            this.dislikedCount--;
          }
        }
      }
      console.log(e);
    });
  },
  data() {
    return {
      isLiked: this.Liked,
      isDisliked: this.Disliked,
      likedCount: this.LikeCount,
      dislikedCount: this.DislikeCount,
    };
  },
  methods: {
    like() {
      if (!this.isLiked && !this.isDisliked) {
        this.likedCount++;
        this.isLiked = true;
        this.changeLikeStatus("1");

        console.log("phase 1");
      } else {
        if (!this.isDisliked) {
          this.likedCount--;
          this.isLiked = false;
          this.deleteLikeStatus("like");
          console.log("phase 2");
        } else {
          this.likedCount++;
          this.dislikedCount--;
          this.isDisliked = false;
          this.isLiked = true;
          this.changeLikeStatus("1");
          this.deleteLikeStatus("dislike");

          console.log("phase 3");
        }
      }
      //   axios.put(`/api/likes/${this.replyId}`,{status: this.isLiked})
      //     .then(res => console.log(res.data))
      //     .catch(err => console.log(err))
    },
    dislike() {
      if (!this.isLiked && !this.isDisliked) {
        this.dislikedCount++;
        this.isDisliked = true;
        this.changeLikeStatus("-1");
        console.log("phase 11");
      } else {
        if (!this.isLiked) {
          this.dislikedCount--;
          this.isDisliked = false;
          this.deleteLikeStatus("dislike");

          console.log("phase 22");
        } else {
          this.dislikedCount++;
          this.likedCount--;
          this.isLiked = false;
          this.isDisliked = true;
          this.changeLikeStatus("-1");
          this.deleteLikeStatus("like");

          console.log("phase 33");
        }
      }

      //     this.$emit("componentLiked", {
      //     isLiked: this.isLiked,
      //     likeCount: this.dislikeCount,
      //   });
    },
    changeLikeStatus(status) {
      axios
        .put(`/api/likes/${this.replyId}`, { status })
        .then((res) => console.log(res.data))
        .catch((err) => console.log(err));
    },
    deleteLikeStatus(type) {
      axios
        .delete(`/api/likes/${this.replyId}/${type}`)
        .then((res) => console.log(res.data))
        .catch((err) => console.log(err));
    },

    //   this.isLiked = !this.isLiked;

    /////////

    //   if (!this.isDisliked) {
    //     this.dislikeCount++;
    //   } else {
    //     this.dislikeCount--;
    //   }
    //   this.isDisliked = !this.isDisliked;
    //   this.$emit("componentDisliked", {
    //     isDisliked: this.isDisliked,
    //     dislikeCount: this.count,
    //   });
    // },
  },
};
</script>

<style>
</style>
