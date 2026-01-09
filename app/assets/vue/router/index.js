import {createRouter,createWebHistory} from 'vue-router'
import HomePage from "../pages/HomePage.vue";
import { useAuthStore } from '../stores/auth.js';

const routes = [
    {path:'/', component: HomePage, meta: { public: true }},
    {path:'/login', name:'login', component: () => import('../pages/LoginPage.vue'), meta: { guestOnly: true }},
    {path:'/register', name:'register', component: ()  => import('../pages/RegisterPage.vue'), meta: { guestOnly: true }},
    {path:'/user', name: 'user_personal', component: () => import('../pages/PersonalPage.vue'), meta: { requiresAuth: true }},
    {path:'/admin/dashboard', name: 'admin_dashboard', component: () => import('../pages/AdminDashboardPage.vue'), meta: { requiresAuth: true, requiredRole: 'ROLE_ADMIN'}},
    {path:'/inventory/:id', name:'inventory_show', component: () => import('../components/Inventory/Inventory.vue'), meta: { requiresAuth: true }, props: true},
    {path:'/inventory/create', name:'inventory_create', component: () => import('../components/Inventory/InventoryCreate.vue'), meta: { requiresAuth: true }},
    {path: '/:catchAll(.*)', name:'404', component: () => import('../components/NotFound.vue')}
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

router.beforeEach(async (to, from, next) => {
    const authStore = await useAuthStore();

    if (authStore.token && !authStore.user) {
        //await authStore.fetchUser();
    }

    if (to.meta.guestOnly && authStore.isAuthenticated) {
        next({ name: 'user_personal' });
        return;
    }

    if (to.meta.public || to.meta.guestOnly) {
        next();
        return;
    }

    if (to.meta.requiresAuth && !authStore.isAuthenticated) {
        next({ name: 'login' });
        return;
    }

    if (to.meta.requiredRole && !authStore.user?.roles?.includes(to.meta.requiredRole)) {
        next({ name: 'user_personal' }); // maybe 403
        return;
    }

    next();
});

export default router;
