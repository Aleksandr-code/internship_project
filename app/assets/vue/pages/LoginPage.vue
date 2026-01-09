<script setup>
import LogoIcon from "../components/icons/LogoIcon.vue";
import { ref, computed } from 'vue';
import { useRouter } from 'vue-router';
import { useAuthStore } from "../stores/auth.js";

const email = ref('');
const password = ref('');
const router = useRouter();
const authStore = useAuthStore();

const loading = computed(() => authStore.loading);
const error = computed(() => authStore.error);

const handleLogin = async () => {
    await authStore.login(email.value, password.value);
    router.push({name: 'user_personal'})
}

</script>

<template>
    <main class="form-signin w-100 m-auto py-5">
        <form @submit.prevent="handleLogin">
            <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
            <div class="form-floating">
                <input v-model="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com" required>
                <label for="floatingInput">Email address</label>
            </div>
            <div class="form-floating mt-3">
                <input v-model="password" type="password" class="form-control" id="floatingPassword" placeholder="Password" required>
                <label for="floatingPassword">Password</label>
            </div>
            <div class="text-end my-3">
                <a href="#" class="text-decoration-none">Register</a>
            </div>
            <p v-if="error" class="text-bg-danger p-2">{{ error }}</p>
            <button class="btn btn-primary w-100 py-2" type="submit" :disabled="loading">Sign in</button>
            <div class="d-flex mt-3 gap-3">
                <hr class="flex-grow-1">
                <div class="d-flex gap-2">
                    <button class="rounded"><i class="bi bi-google"></i></button>
                    <button class="rounded"><i class="bi bi-github"></i></button>
                </div>
                <hr class="flex-grow-1">
            </div>
            <p class="mt-5 mb-3 text-body-secondary text-center">© 2025</p>
        </form>
    </main>
</template>

<style scoped>
.form-signin{
    max-width: 330px;
    padding: 1rem;
}
</style>
