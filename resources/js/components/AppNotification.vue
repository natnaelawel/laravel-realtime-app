<template>
  <v-menu bottom origin="center center" transition="scale-transition">
    <template v-slot:activator="{ on, attrs }">
      <v-badge style="padding: 0 10px" :content="unReadCount" :value="unReadCount" color="primary" dark overlap>
        <v-icon v-bind="attrs" v-on="on">{{ (unReadCount > 0) ? 'mdi-bell': 'mdi-bell-outline' }}</v-icon>
      </v-badge>
    </template>

    <v-list>
      <template v-if="unReadCount">
      <v-list-item  v-for="notification in unRead" :key="notification.id">
        <router-link :to="{ name: 'showSingleQuestion', params: { slug: slugify(notification.question) }}" >
          <v-list-item-title @click="markAsRead(notification)">

            <p><strong>{{ notification.question }}</strong> replied by : {{ notification.replyBy }}</p>
          </v-list-item-title>
        </router-link>
      </v-list-item>
      </template>
      <template v-else>
        <v-list-item >
          <v-list-item-title>
            <p>no new notification</p>
          </v-list-item-title>
      </v-list-item>
      </template>
      <v-divider></v-divider>
        <v-list-item v-for="notification in read" :key="notification.id">
     <v-list-item-title>
            <strong>{{ notification.question }}</strong>
            <p>replied by : {{ notification.replyBy }}</p>
          </v-list-item-title>
        </v-list-item>
    </v-list>
  </v-menu>
</template>

<script>
export default {
  data() {
    return {
      read: {},
      unRead: {},
      unReadCount: 0,
    };
  },
  created() {
    if (User.loggedIn()) {
      this.getNotifications();
    }
  },
  methods: {
    getNotifications() {
      axios.post("/api/notifications").then((res) => {
        this.read = res.data.read;
        (this.unRead = res.data.unRead),
          (this.unReadCount = res.data.unRead.length);
      });
    },
    markAsRead(notification) {
      axios
        .post("/api/markAsRead", { id: notification.id })
        .then((res) => {
          this.unRead.splice(notification, 1);
          this.read.push(notification);
          this.unReadCount--;
        })
        .catch((err) => console.log(err));
    },
    slugify(value) {
      return value.toLocaleLowerCase().replace(/ /g, "-").replace(".", "");
    },
  },
};
</script>

<style>
</style>
