<template>
  <div>
    <v-btn text @click="dislike">
      <span style="padding: 20px; font-weight: bold">{{ count }}</span>
      <v-icon>{{ isDisliked && !Liked ? 'mdi-thumb-down': 'mdi-thumb-down-outline' }}</v-icon>
    </v-btn>
  </div>
</template>

<script>
export default {
  props: {
    Liked: {
      type: Boolean,
    },
    Disliked: {
      type: Boolean,
      default: false,
    },
    DislikeCount: {
      type: Number,
      default: 10,
    },
  },
  mounted() {
    console.log("liked is ", this.Liked);
  },
  data() {
    return {
      isDisliked: this.Disliked,
      count: this.DislikeCount,
    };
  },
  methods: {
    dislike() {
      if (!this.isDisliked) {
        this.count++;
      } else {
        this.count--;
      }
      this.isDisliked = !this.isDisliked;
      this.$emit("componentDisliked", {
        isDisliked: this.isDisliked,
        dislikeCount: this.count,
      });
    },
  },
};
</script>

<style>
</style>
