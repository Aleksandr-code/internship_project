import {createRouter,createWebHistory} from 'vue-router'
import HomePage from "../pages/HomePage.vue";

const routes = [
    {path:'/', component: HomePage},
    {path:'/login', component: () => import('../pages/LoginPage.vue')},
    {path:'/register', component: ()  => import('../pages/RegisterPage.vue')},
    {path:'/user/:id', component: () => import('../pages/PersonalPage.vue')},
    {path:'/admin/dashboard', component: () => import('../pages/AdminDashboardPage.vue')},
    {path:'/inventory/:id', component: () => import('../components/Inventory/Inventory.vue')},
    {path: '/:catchAll(.*)', component: () => import('../components/NotFound.vue')}
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router;
