<template>
  <div>
      <h2>Component A Disliked={{ Disliked }}</h2>
      <button @click="like">
              <v-icon>{{ isLiked && !Disliked ? 'mdi-thumb-up': 'mdi-thumb-up-outline' }}</v-icon>
      </button>
  </div>
</template>

<script>
export default {
    props:{
        Disliked:{
            type: Boolean
        }
    },
    mounted(){
        console.log('disliked is ',this.Disliked )
    },
    data(){
        return {
            isLiked: false
        }
    },
    methods:{
        like(){
            this.isLiked = true
            this.$emit('componentLiked', true)
        }
    }

}
</script>

<style>

</style>
