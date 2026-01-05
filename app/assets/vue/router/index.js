import {createRouter,createWebHistory} from 'vue-router'
import HomePage from "../pages/HomePage.vue";

const routes = [
    {path:'/', component: HomePage},
    {path:'/login', name:'login', component: () => import('../pages/LoginPage.vue')},
    {path:'/register', name:'register', component: ()  => import('../pages/RegisterPage.vue')},
    {path:'/user/:id', name: 'user_personal', component: () => import('../pages/PersonalPage.vue')},
    {path:'/admin/dashboard', name: 'admin_dashboard', component: () => import('../pages/AdminDashboardPage.vue')},
    {path:'/inventory/:id', name:'inventory_show', component: () => import('../components/Inventory/Inventory.vue'), props: true},
    {path:'/inventory/create', name:'inventory_create', component: () => import('../components/Inventory/InventoryCreate.vue')},
    {path: '/:catchAll(.*)', component: () => import('../components/NotFound.vue')}
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router;
