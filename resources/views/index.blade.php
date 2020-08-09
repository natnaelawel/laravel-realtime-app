<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>


    <title>Home</title>

    <script>
    const app = new Vue({
        el: '#app',
        vuetify: new Vuetify(),
        data () {
            return {
                drawer: true,
                items: [
                    { title: 'Dashboard', icon: 'mdi-view-dashboard' },
                    { title: 'Photos', icon: 'mdi-image' },
                    { title: 'About', icon: 'mdi-help-box' },
                ],
                color: 'primary',
                colors: [
              'primary',
              'blue',
              'success',
              'red',
              'teal',
            ],
            right: false,
            permanent: true,
            miniVariant: false,
            expandOnHover: false,
            background: false,
        }
    },
    computed: {
        bg () {
            return this.background ? 'https://cdn.vuetifyjs.com/images/backgrounds/bg-2.jpg' : undefined
        },
    },
});
      </script>
</head>
<body>
    <div id="app">
        <v-app>
          <v-navigation-drawer
          v-model="drawer"
          :color="color"
          :expand-on-hover="expandOnHover"
          :mini-variant="miniVariant"
          :right="right"
          :permanent="permanent"
          :src="bg"
          absolute
          dark
        >
          <v-list
          dense
          nav
            class="py-0"
            >
            <v-list-item two-line :class="miniVariant && 'px-0'">
              <v-list-item-avatar>
                <img src="https://randomuser.me/api/portraits/men/81.jpg">
              </v-list-item-avatar>

              <v-list-item-content>
                <v-list-item-title>Application</v-list-item-title>
                <v-list-item-subtitle>Subtext</v-list-item-subtitle>
              </v-list-item-content>
              </v-list-item>
              
            <v-divider></v-divider>

            <v-list-item
              v-for="item in items"
              :key="item.title"
              link
            >
              <v-list-item-icon>
                <v-icon>{{ item.icon }}</v-icon>
              </v-list-item-icon>

              <v-list-item-content>
                <v-list-item-title>{{ item.title }}</v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </v-list>
        </v-navigation-drawer>


            <v-toolbar
            dark
            src="https://cdn.vuetifyjs.com/images/backgrounds/vbanner.jpg"
          >
            <v-app-bar-nav-icon  @click.stop="drawer = !drawer"></v-app-bar-nav-icon>

            <v-toolbar-title>Laravel Forum</v-toolbar-title>

            <v-spacer></v-spacer>

            <v-btn icon>
              <v-icon>mdi-export</v-icon>
            </v-btn>
          </v-toolbar>
        </v-app>

    <v-main>
        <v-container
          class="fill-height"
          fluid
        >
          <v-row
            align="center"
            justify="center"
          >
            <v-col class="text-center">
              <v-tooltip left>
                <template v-slot:activator="{ on }">
                  <v-btn
                    :href="source"
                    icon
                    large
                    target="_blank"
                    v-on="on"
                  >
                    <v-icon large>mdi-code-tags</v-icon>
                  </v-btn>
                </template>
                <span>Source</span>
              </v-tooltip>
            </v-col>
          </v-row>
        </v-container>
      </v-main>
      <v-footer
        color="indigo"
        app
      >
        {{-- <span class="white--text">&copy; {{ new Date().getFullYear() }}</span> --}}
      </v-footer>
    </div>

</body>


</html>
