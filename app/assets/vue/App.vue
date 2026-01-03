<script setup>
    import { ref } from 'vue'
    import Header from "./components/Header.vue";

    const test = ref('text')
</script>

<template>
    <div class="container">
        <Header></Header>
        <router-view></router-view>
    </div>
</template>

<style scoped>

</style>
