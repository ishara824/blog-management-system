import Login from "../components/Login.vue";
import {createRouter, createWebHistory} from "vue-router";
import Register from "../components/Register.vue";
import Dashboard from "../components/Dashboard.vue";
import CreateBlog from "../components/CreateBlog.vue";
import EditBlog from "../components/EditBlog.vue";
import AllBlogs from "../components/AllBlogs.vue";

const routes = [
    {
        path: '/login',
        name: 'Login',
        component: Login
    },
    {
        path: '/register',
        name: 'Register',
        component: Register
    },
    {
        path: '/dashboard',
        name: 'Dashboard',
        component: Dashboard,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/create-blog',
        name: 'CreateBlog',
        component: CreateBlog,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/edit-blog/:id',
        name: 'EditBlog',
        component: EditBlog,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/all-blogs',
        name: 'AllBlogs',
        component: AllBlogs,
        meta: {
            requiresAuth: false
        }
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes: routes
})

router.beforeEach((to, from) => {
    if (to.meta.requiresAuth && !localStorage.getItem('token')) {
        return { name: 'Login' }
    }
    if (!to.meta.requiresAuth && localStorage.getItem('token')) {
        return { name: 'Dashboard' }
    }
});


export default router
