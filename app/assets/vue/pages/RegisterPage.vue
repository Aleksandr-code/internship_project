<script setup>

import LogoIcon from "../components/icons/LogoIcon.vue";
</script>

<template>
    <main class="form-register w-100 m-auto py-5">
        <form>
            <h1 class="h3 mb-3 fw-normal">Registration</h1>
            <div class="form-floating">
                <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Email address</label>
            </div>
            <div class="form-floating mt-3">
                <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Password</label>
            </div>
            <div class="form-floating mt-3">
                <input type="password" class="form-control" id="floatingPassword" placeholder="Repeat password">
                <label for="floatingPassword">Repeat password</label>
            </div>
            <a class="btn btn-primary w-100 py-2 mt-3" type="submit">Register</a>
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
