<template>
  <v-btn icon @click="dislike">
     <span style='padding: 20px 0'>{{ " " }} {{ count }} </span>
     <v-icon>{{ isDisliked ? 'mdi-thumb-down': 'mdi-thumb-down-outline' }}</v-icon>
  </v-btn>
</template>

<script>
export default {
  props: {
      Disliked:{
          type: Boolean,
          default: false
      },
      DislikeCount:{
          type: Number,
          default: 10
      }
  },
  mounted(){
      this.$root.$on('Replyliked', (isLiked) => {
          if(isLiked){
            console.log('liked by event')
              this.isDisliked = false
          }
      })
  },
  data() {
    return {
        // count: this.DislikeCount,
        // isDisliked: this.Disliked
    };
  },
  methods:{
   dislike(){
       console.log('is liked ', this.isDisliked)
       if(this.isDisliked){
           this.count--
           this.isDisliked = false

       }else{
           this.count++
           this.isDisliked = true
       }
       this.$emit('disliked', {dislikedCount: this.count, isDisliked: this.isDisliked})
        if(this.isLiked){
          this.$emit("Replyliked", his.isLiked );
        }
   }
  },
  computed:{
      dislikeCount: {
          get(){
              return this.DislikeCount;
          },
          set(value){

          }
      },
    count: {
      get() {
        return this.DislikeCount;
      },
      set(value) {
          return value
      },
    },
    isDisliked: {
      get() {
        return this.Disliked;
      },
      set(value) {
          return value
      },
    },
  },
    watch:{
      'Disliked': (value)=>{
          this.isDisliked = value;
      },
      'DislikeCount': (value) =>{
          this.count = value
      }
  }
};
</script>

<style>
</style>
