/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import Vue from 'vue';
import Vuetify from 'vuetify';

Vue.use(Vuetify);

import VueSimplemde from 'vue-simplemde';

Vue.use(VueSimplemde);

import VueRouter from 'vue-router';

Vue.use(VueRouter);

import vuelidate from 'vuelidate';

Vue.use(vuelidate);

import router from './routes';

import User from './helpers/User';

window.User = User;



// import colors from 'vuetify/lib/util/colors';


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

import AppIndex from './components/AppIndex.vue';
import Home from './components/Home.vue';
import Nav from './components/includes/AppNav.vue';
import Footer from './components/includes/AppFooter.vue';
Vue.component('AppNav', Nav);
Vue.component('AppIndex', AppIndex);
Vue.component('AppFooter', Footer);
Vue.component('AppHome', Home);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    vuetify: new Vuetify(),
    router
});

// vuetify: new Vuetify({
//     theme: {
//         themes: {
//           light: {
//             primary: colors.blue.darken-3, // #E53935
//             secondary: colors.blue.lighten-3, // #FFCDD2
//             accent: colors.indigo.base, // #3F51B5
//           },
//         },
//       },
// }),
