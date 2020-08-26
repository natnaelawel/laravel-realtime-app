<template>
  <v-btn icon @click="like">
    <span style="padding: 20px 0">{{ " " }} {{ count }}</span>
    <v-icon>{{ isLiked ? 'mdi-thumb-up': 'mdi-thumb-up-outline' }}</v-icon>
  </v-btn>
</template>

<script>
export default {
  mounted() {
       this.$root.$on('ReplyDisliked', (isDisliked) => {
          if(isDisliked){
              console.log('disliked by event')
              this.isLiked = false
          }
      })
  },
  props: {
    Liked: {
      type: Boolean,
      default: false,
    },
    LikeCount: {
      type: Number,
      default: 10,
    },
  },
  data() {
    return {

    };
  },
  methods: {
    like() {
      console.log("is liked ", this.isLiked);
      if (this.isLiked) {
        this.count--;
        this.isLiked = false;
      } else {
        this.count++;
        this.isLiked = true;
      }
      this.$emit("liked", { likedCount: this.count, isLiked: this.isLiked });
      if(this.isLiked){
          this.$emit("Replyliked", this.isLiked);
      }
    },
  },
  computed: {
    likeCount: {
      get() {
        return this.LikeCount;
      },
      set(value) {},
    },
    count: {
      get() {
        return this.LikeCount;
      },
      set(value) {
          return value
      },
    },
    isLiked: {
      get() {
        return this.Liked;
      },
      set(value) {
          return value
      },
    },
  },
  watch:{
      'Liked': (value)=>{
          this.isLiked = value;
      },
      'LikeCount': (value) =>{
          this.count = value
      }
  }
};
</script>

<style>
</style>
