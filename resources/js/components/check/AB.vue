<template>
  <div>
      <h1>Dislike {{ isDisliked }}</h1>
      <h1>like {{ isLiked }}</h1>
      <a-component  @componentLiked="likedFunc"  :Disliked="isDisliked"></a-component>
      <b-component @componentDisliked="dislikedFunc" :Liked="isLiked"></b-component>
  </div>
</template>

<script>
    import A from './A'
    import B from './B'
export default {
    data(){
        return{
            isLiked: false,
            isDisliked: false
        }
    },
    methods:{
        likedFunc(value){
            if(value){
                this.isDisliked = false
                this.isLiked = true
            }

        },
        dislikedFunc(value){
            if(value){
                this.isDisliked = true
                this.isLiked = false
            }
        }
    },
    components:{
        aComponent: A,
        bComponent: B,
    }
}
</script>

<style>

</style>
