import VueRouter from "vue-router";
import Home from "./components/Home.vue";
const routes = [
    { path: '/', component: Home },
    { path: '/login', component: Login },
    { path: '/register', component: Register },
    { path: '/forum', component: Home }
  ]
const router = new VueRouter({
    mode:"history",
    routes // short for `routes: routes`
  });

export default router;