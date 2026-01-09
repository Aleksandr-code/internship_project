import { defineStore } from 'pinia'
import {login, register, me} from '../api/auth.js'

export const useAuthStore = defineStore('auth', {
    state: () => ({
        token: localStorage.getItem('token') || null,
        user: null,
        loading: false,
        error: null
    }),

    getters: {
        isAuthenticated: (state) => !!state.token,
        isAdmin: (state) => state.user?.roles?.includes('ROLE_ADMIN') || false,
        isUser: (state) => state.user?.roles?.includes('ROLE_USER') || false,
    },

    actions:{
        async login(email, password) {
            this.loading = true;
            this.error = null;
            try {
                const { token } = await login(email, password);
                this.setToken(token);
                await this.fetchUser()
            } catch (err) {
                this.error = err.response?.data?.message || 'Login failed';
            } finally {
                this.loading = false;
            }
        },

        async register(email, password) {
            this.loading = true;
            this.error = null;
            try {
                const { token } = await register(email, password);
                this.setToken(token);
            } catch (err) {
                this.error = err.response?.data?.message || 'Registration failed';
                throw err;
            } finally {
                this.loading = false;
            }
        },

        setToken(token) {
            this.token = token;
            localStorage.setItem('token', token);
        },

        async fetchUser() {
            try {
                const data = await me()
                this.user = data.user;
            } catch (error) {
                console.log('Failed to fetch user', error);
            }
        },

        logout() {
            this.token = null;
            this.user = null;
            localStorage.removeItem('token');
        },
    },
})
