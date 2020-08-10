import VueRouter from "vue-router";
import Home from "./components/Home.vue";
import Login from './components/Login/Login.vue';
import Register from './components/Login/Register.vue';
const routes = [
    { path: '/', component: Home },
    { path: '/login', component: Login },
    { path: '/register', component: Register },
    { path: '/forum', component: Home }
  ]
const router = new VueRouter({
    mode:"history",
    hashBang: false,
    routes // short for `routes: routes`
  });

export default router;