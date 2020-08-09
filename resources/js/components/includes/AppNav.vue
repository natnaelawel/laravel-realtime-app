<template>
  <nav>
    <v-navigation-drawer
      v-model="drawer"
      :color="color"
      expand-on-hover
      :mini-variant="miniVariant"
      :src="bg"
      absolute
      dark
      class="drawer"
      persistent
      clipped
      app
    >
      <v-list dense nav class="py-0">
        <v-list-item two-line :class="miniVariant && 'pa-0'">
          <v-list-item-avatar>
            <v-img src="https://randomuser.me/api/portraits/men/81.jpg" />
          </v-list-item-avatar>

          <v-list-item-content>
            <v-list-item-title>Natnael Awel</v-list-item-title>
            <v-list-item-subtitle>Admin</v-list-item-subtitle>
          </v-list-item-content>
        </v-list-item>

        <v-divider></v-divider>

        <template v-for="item in items" >
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

    <v-toolbar dark src="https://cdn.vuetifyjs.com/images/backgrounds/vbanner.jpg">
      <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>

      <v-toolbar-title>Laravel Forum</v-toolbar-title>

      <v-spacer></v-spacer>

      <v-btn icon>
        <v-item>Sign Up</v-item>
        <v-icon>mdi-export</v-icon>
      </v-btn>

      
    </v-toolbar>
  </nav>
</template>

<script>
// import NavBar from "./NavBar";
// import NavDrawer from "./NavDrawer";
export default {
  data() {
    return {
      drawer: false,
      items: [
        { title: "Dashboard", icon: "mdi-view-dashboard" },
        { title: "Photos", icon: "mdi-image" },
        { title: "About", icon: "mdi-help-box" },
      ],
      color: "primary",
      colors: ["primary", "blue", "success", "red", "teal"],
      right: false,
      permanent: false,
      miniVariant: true,
      expandOnHover: true,
      background: false,
    };
  },
  computed: {
    bg() {
      return this.background
        ? "https://cdn.vuetifyjs.com/images/backgrounds/bg-2.jpg"
        : undefined;
    },
  },
  components: {
    // appNavBar : NavBar,
    // appNavDrawer : NavDrawer
  },
};
</script>

<style lang="scss" scoped>
    .drawer{
        margin-top: 64px;
    }
</style>>
