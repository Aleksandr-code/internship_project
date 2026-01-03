<script setup>

import LogoIcon from "../components/icons/LogoIcon.vue";
</script>

<template>
    <main class="form-signin w-100 m-auto py-5">
        <form>
            <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
            <div class="form-floating">
                <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Email address</label>
            </div>
            <div class="form-floating mt-3">
                <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Password</label>
            </div>
            <div class="text-end my-3">
                <a href="#" class="text-decoration-none">Register</a>
            </div>
            <a class="btn btn-primary w-100 py-2" type="submit">Sign in</a>
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
