<script setup>
    import { ref } from 'vue'

    const test = ref('text')
</script>

<template>
    <div class="container">
        <header>Header</header>
        <router-view></router-view>
    </div>
</template>

<style scoped>

</style>
