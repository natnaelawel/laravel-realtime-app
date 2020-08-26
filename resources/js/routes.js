import VueRouter from "vue-router";
import Welcome from "./components/Welcome.vue";
import Home from "./components/Home.vue";
import Forum from "./components/Forum/Index.vue";
import Questions from "./components/Forum/Questions.vue";
import SingleQuestion from './components/Forum/QuestionShow.vue';
import CreateQuestion from './components/Forum/Create.vue';
import EditeQuestion from './components/Forum/Edit.vue';
import CreateCategory from './components/Category/Create.vue';
import Login from './components/Login/Login.vue';
import Register from './components/Login/Register.vue';
import User from "./helpers/User";

const isAuthenticated = () => {
    return User.loggedIn();
};

const routes = [{
        path: '/',
        name: 'welcome',
        component: Welcome,
        beforeEnter: (to, from, next) => {
            if (!isAuthenticated()) {
                next();
            } else {
                next({
                    name: 'home'
                });
            }
        },
        meta: {
            requiresAuth: false,
        }
    },
    {
        path: '/login',
        name: 'login',
        component: Login,
        meta: {
            requiresAuth: false,
        },
        beforeEnter: (to, from, next) => {
            if (!isAuthenticated()) {
                next();
            } else {
                next({
                    name: 'home'
                });
            }
        },

    },
    {
        path: '/register',
        name: 'register',
        component: Register,
        meta: {
            requiresAuth: false,
        },
        beforeEnter: (to, from, next) => {
            if (!isAuthenticated()) {
                next();
            } else {
                next({
                    name: 'home'
                });
            }
        },
    },
    {
        path: '/home',
        name: 'home',
        component: Home,
        meta: {
            requiresAuth: true,
        }
    },
    {
        path: '/category',
        name: 'createCategory',
        component: CreateCategory,
        meta: {
            requiresAuth: true,
        },
        beforeEnter: (to, from, next) => {
            if (isAuthenticated()) {
                next();
            } else {
                next({
                    name: 'welcome'
                });
            }
        },
    },
    {
        path: '/forum',
        name: 'forum',
        component: Forum,
        children: [{
                path: '',
                name: 'questions',
                component: Questions,
                meta: {
                    requiresAuth: false,
                },

            },
            {
                name: 'createQuestion',
                path: 'question/create',
                component: CreateQuestion,
                meta: {
                    requiresAuth: true,
                },
                beforeEnter: (to, from, next) => {
                    if (isAuthenticated()) {
                        next();
                    } else {
                        next({
                            name: 'welcome'
                        });
                    }
                },
            },
            {
                path: 'question/:slug',
                name: 'showSingleQuestion',
                component: SingleQuestion,
                meta: {
                    requiresAuth: false,
                },

            },
            {
                name: 'editSingleQuestion',
                path: 'question/:slug/edit',
                component: EditeQuestion,
                meta: {
                    requiresAuth: true,
                },
                beforeEnter: (to, from, next) => {
                    if (isAuthenticated()) {
                        next();
                    } else {
                        next({
                            name: 'welcome'
                        });
                    }
                },
            }
        ]
    },
];
const router = new VueRouter({
    mode: "history",
    hashBang: false,
    routes // short for `routes: routes`
});

// router.beforeEach((to, from, next) => {
//     console.log('to is ', to);
//     if (to.matched.some(record => record.meta.requiresAuth)) {
//         if (!isAuthenticated()) {
//             console.log('require authorization true and is not authenticated');
//             next({
//                 name: 'login',
//                 // params: { nextUrl: to.fullPath }
//             });
//         } else {
//             console.log('require authorization true and is authenticated authenticated');
//             next();
//         }
//     } else {
//         if (isAuthenticated()) {
//             console.log('require authorization false and is authenticated');
//             if(to.path == '/register' || to.path == '/login'){

//                 next({
//                     name: 'home',
//                     // params: { nextUrl: to.fullPath }
//                 });
//             }else{
//                 next();
//             }
//         } else {
//             console.log('require authorization false and is not authenticated');
//             next();
//         }

//     }
// });


export default router;

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
