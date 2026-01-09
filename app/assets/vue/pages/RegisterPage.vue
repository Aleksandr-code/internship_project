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

const handleRegister = async () => {
    await authStore.register(email.value, password.value);
    router.push({name: 'user_personal'})
}
</script>

<template>
    <main class="form-register w-100 m-auto py-5">
        <form @submit.prevent="handleRegister">
            <h1 class="h3 mb-3 fw-normal">Registration</h1>
            <div class="form-floating">
                <input v-model="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Email address</label>
            </div>
            <div class="form-floating mt-3">
                <input v-model="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Password</label>
            </div>
            <p v-if="error" class="text-bg-danger p-2 mt-3">{{ error }}</p>
            <button class="btn btn-primary w-100 py-2 mt-3" type="submit">Register</button>
            <div class="text-center my-3">
                <a href="#" class="text-decoration-none">Sign in</a>
            </div>
            <p class="mt-5 mb-3 text-body-secondary text-center">© 2025</p>
        </form>
    </main>
</template>

<style scoped>
.form-register{
    max-width: 330px;
    padding: 1rem;
}
</style>
