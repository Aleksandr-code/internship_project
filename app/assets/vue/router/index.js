import {createRouter,createWebHistory} from 'vue-router'
import HomePage from "../pages/HomePage.vue";

const routes = [
    {path:'/', component: HomePage},
    {path:'/user/:id', component: () => import('../pages/PersonalPage.vue')},
    {path:'/admin/dashboard', component: () => import('../pages/AdminDashboardPage.vue')},

]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router;
