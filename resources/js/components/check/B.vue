<template>
  <div>
      <h2>Component B  A liked={{ Liked }}</h2>
      <button @click="dislike">
        <v-icon>{{ isDisliked && !Liked ? 'mdi-thumb-down': 'mdi-thumb-down-outline' }}</v-icon>
      </button>
  </div>
</template>

<script>
export default {
    props:{
        Liked:{
            type: Boolean
        }
    },
    mounted(){
        console.log('liked is ',this.Liked )
    },
    data(){
        return {
            isDisliked: false
        }
    },
    methods:{
        dislike(){
            this.isDisliked = true
            this.$emit('componentDisliked', true)
        }
    }

}
</script>

<style>

</style>
