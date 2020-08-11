<template>
  <nav >
    <v-navigation-drawer
      v-model="drawer"
      :color="color"
      :mini-variant="mini"
      height="calc(100vh - 62px)"
      miniVariantWidth="57"
      :src="bg"
      absolute
      dark
      persistent
      clipped
      app
      fixed
      permanent
      :style="'top:'+toolbarSize"
    >
      <v-list dense nav class="py-0">
        <v-list-item two-line class="pa-0">
          <v-list-item-avatar>
            <v-img src="https://randomuser.me/api/portraits/men/81.jpg" />
          </v-list-item-avatar>

          <v-list-item-content>
            <v-list-item-title>Natnael Awel</v-list-item-title>
            <v-list-item-subtitle>Admin</v-list-item-subtitle>
          </v-list-item-content>
        </v-list-item>

        <v-divider></v-divider>

        <template v-for="item in items">
          <v-list-item :key="item.title" link>
            <v-list-item-icon>
              <v-icon>{{ item.icon }}</v-icon>
            </v-list-item-icon>

            <v-list-item-content>
              <v-list-item-title>{{ item.title }}</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </template>
      </v-list>
      <template v-slot:append>
        <v-list-item link>
          <v-list-item-icon>
            <v-icon>mdi-export</v-icon>
          </v-list-item-icon>
          <v-list-item-content>
            <v-list-item-title>Logout</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </template>
    </v-navigation-drawer>

    <v-toolbar class="sticky" dark src="https://cdn.vuetifyjs.com/images/backgrounds/vbanner.jpg">
      <v-app-bar-nav-icon @click.native.stop="mini = !mini"></v-app-bar-nav-icon>

      <v-toolbar-title>Laravel Forum</v-toolbar-title>

      <v-spacer></v-spacer>
      <v-toolbar-items class="hidden-sm-and-md">
        <v-btn text>
            <router-link class="toolbar-link" :to="{path:'/forum'}">
                Forum
            </router-link>
        </v-btn>
        <v-btn text>
            <router-link class="toolbar-link" :to="{name:'createQuestion'}">
                Ask Question
            </router-link>
        </v-btn>
          <v-btn text>
              <router-link class="toolbar-link" to="/category">Category</router-link>
          </v-btn>
        <template v-if="!isLoggedIn">
          <v-btn text >
              <router-link class="toolbar-link" to="/register">Signup</router-link>
          </v-btn>
          <v-btn text>
            <router-link class="toolbar-link" to="/login">Signin</router-link>
          </v-btn>
        </template>
        <template v-else>
          <v-btn text color="white"  @click.prevent="logout" >
              Logout
          </v-btn>
        </template>
      </v-toolbar-items>
    </v-toolbar>
  </nav>
</template>

<script>
// import NavBar from "./NavBar";
// import NavDrawer from "./NavDrawer";
export default {
  data() {
    return {
      drawer: true,
      items: [
        { title: "Dashboard", icon: "mdi-view-dashboard" },
        { title: "Photos", icon: "mdi-image" },
        { title: "About", icon: "mdi-help-box" },
      ],
      color: "primary",
      colors: ["primary", "blue", "success", "red", "teal"],
      permanent: false,
      expand: false,
      mini: false,
      background: true,
      isLoggedIn: false,
    };
  },
  computed: {
    bg() {
      return this.background
        ? "https://cdn.vuetifyjs.com/images/backgrounds/bg-2.jpg"
        : undefined;
    },
    toolbarSize() {
      this.$vuetify.breakpoint.name !== 'sm' ? this.mini = true : this.mini = false
      // eslint-disable-next-line vue/no-side-effects-in-computed-properties
      switch (this.$vuetify.breakpoint.name) {
        case "xs":
        case "sm":
          return "56px";
        case "md":
          return "64px";
        case "lg":
          return "64px";
        case "xl":
          return "70px";
        default:
          return "64px";
      }
    },
  },
  mounted() {
    this.isLoggedIn = User.loggedIn();
    this.$vuetify.breakpoint.name === "sm"
      ? (this.mini = !this.mini)
      : (this.mini = !this.mini);
  },
  components: {
    // appNavBar : NavBar,
    // appNavDrawer : NavDrawer
  },
  methods:{
      logout(){
          User.logOut();
          this.$router.push({name: 'login'});
      }
  }
};
</script>

<style lang="scss" scoped>
    .drawer {
        margin-top: 64px;
    }
    .toolbar-link{
        color: white;
        text-decoration: none;
    }
   .sticky{
    position: fixed !important;
    z-index: 100;
    width: 100%;
    }
</style>>
