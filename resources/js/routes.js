import VueRouter from "vue-router";
import Home from "./components/Home.vue";
import Forum from "./components/Forum/Index.vue";
import Questions from "./components/Forum/Questions.vue";
import SingleQuestion from './components/Forum/QuestionShow.vue';
import CreateQuestion from './components/Forum/Create.vue';
import Login from './components/Login/Login.vue';
import Register from './components/Login/Register.vue';
import User from "./helpers/User";

const isAuthenticated = () => {
    return User.loggedIn();
};

const routes = [{
        path: '/',
        name: 'home',
        component: Home,
        meta: {
            requiresAuth: true,
            // is_admin : true
        }
    },
    {
        path: '/login',
        name: 'login',
        component: Login,
        meta: {
            requiresAuth: false,
        }

        //  beforeEnter: (to, from, next)=>{
        //     console.log(isAuthenticated());
        //     if(isAuthenticated()){
        //         next({
        //             name: 'login'
        //         });
        //     }else{
        //         next({
        //             name: 'home'
        //         });
        //     }
        // }
    },
    {
        path: '/register',
        name: 'register',
        component: Register,
        meta: {
            requiresAuth: false,
        }
        //  beforeEnter: (to, from, next)=>{
        //     if(!isAuthenticated()){
        //         next();
        //     }else{
        //         next({
        //             name: 'home'
        //         });
        //     }
        // }
    },
    {
        path: '/forum',
        name: 'forum',
        component: Forum,
        meta: {
            requiresAuth: true,
        },
        children: [
            {
                path: '',
                name: 'questions',
                component: Questions,
            },
            {
                name:'createQuestion',
                path: 'question/create',
                component: CreateQuestion
            },
            {
                path: 'question/:slug',
                name: 'showSingleQuestion',
                component: SingleQuestion
            },
            {
                name:'editSingleQuestion',
                path: 'posts/:slug/edit',
                component: SingleQuestion
            }
        ]
    },
];
const router = new VueRouter({
    mode: "history",
    hashBang: false,
    routes // short for `routes: routes`
});

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (!isAuthenticated()) {
            next({
                name: 'login',
                // params: { nextUrl: to.fullPath }
            });
        } else {
            next();
        }
    } else if (isAuthenticated()) {
        next({
            name: 'home',
            // params: { nextUrl: to.fullPath }
        });
    } else {
        next();
    }
});


export default router;
