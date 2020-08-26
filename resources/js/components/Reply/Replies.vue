<template>
  <div>
    <h1>Replies</h1>
    <new-reply @created="appendReplies" v-if="slug" :slug="slug"></new-reply>
    <template v-if="allReplies">
      <reply
        v-for="(reply, index) in allReplies"
        @replyUpdated="updateReply"
        @replyDeleted="destroyReply"
        :replyIndex="index"
        :key="reply.id"
        :reply="reply"
      ></reply>
    </template>
  </div>
</template>

<script>
import ReplyVue from "./Reply.vue";
import newReply from "./New.vue";

export default {
  props: ["replies", "slug"],
  data() {
    return {};
  },
  mounted() {
    Echo.private("App.User." + User.id()).notification((notification) => {
      console.log(notification.type);
      console.log('inside mounted')
      this.replies.unshift(notification.reply)
    });

    Echo.channel("deleteReplyChannel")
        .listen('DeleteReplyEvent',(e) => {
      console.log(e);
      console.log('inside mounted delete event');
      for (let index = 0; index < this.replies.length; index++) {
          const element = this.replies[index];
          if(element.id == e.id){
              this.allReplies.splice(index, 1);
          }
      }
    //   this.replies.map((reply)=>{
    //       if(e.id == reply.id){
    //         this.allReplies.splice(reply, 1);
    //       }
    //   })
    });
  },
  methods: {
    appendReplies(reply) {
      console.log("added reply is ", reply);
      //   console.log('whole replies are ', this.replies);
      this.allReplies.unshift(reply);
        console.log('added by the user are ', this.replies);
    },
    destroyReply(index) {
      this.allReplies.splice(index, 1);
      this.$emit("replyDeleted");
    },
    updateReply({ index, updatedReply }) {
      //   this.allReplies[index] = updatedReply;
      //   this.replies[index] = updatedReply;
      this.allReplies = this.allReplies.map((reply) => {
        if (reply.id == updatedReply.id) {
          reply.reply = updatedReply.reply;
        }
      });
      console.log("updated reply is ", this.allReplies);
    },
    listen() {
      Echo.private("App.User." + User.id()).notification((notification) => {
        console.log(notification.type);
        console.log('inside append')

      });
    },
  },
  computed: {
    allReplies: {
      get() {
        return this.replies;
      },
      set(newReplies) {},
    },
  },
  components: {
    reply: ReplyVue,
    newReply: newReply,
  },
};
</script>

<style>
</style>
