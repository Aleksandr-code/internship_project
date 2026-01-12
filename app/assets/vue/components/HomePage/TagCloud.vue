<script setup>
import {ref, onMounted} from "vue";
import {fetchTags} from "../../api/tags.js";

const tags = ref([]);
async function loadData(){
    try {
        const params = {limit: 20}
        tags.value = await fetchTags(params)
        console.log(tags.value )
    } catch (e){
        console.log(e)
    }
}

onMounted(() => {
    loadData()
})
</script>

<template>
    <h4 class="text-center mb-3">Tag Cloud</h4>
    <div class="d-flex flex-wrap gap-2 justify-content-center">
        <a v-for="tag in tags" :key="tag.id" href="#" class="badge bg-warning text-dark text-decoration-none">{{ tag.title }}</a>
    </div>
</template>

<style scoped>

</style>
