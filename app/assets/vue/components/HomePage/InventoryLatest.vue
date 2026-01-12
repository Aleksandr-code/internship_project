<script setup>

import {ref, onMounted} from "vue";
import {fetchLatestInventories} from "../../api/inventories.js";

const latestInventories = ref([]);
async function loadData(){
    try {
        latestInventories.value = await fetchLatestInventories()
    } catch (e){
        console.log(e)
    }
}

onMounted(() => {
    loadData()
})

</script>

<template>
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <h4 class="border-bottom pb-2 mb-0">Latest Invetories</h4>
        <div class="table-responsive">
            <table class="table">
                <thead class="table-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Inventory</th>
                        <th scope="col">Description</th>
                        <th scope="col">Creator</th>
                    </tr>
                </thead>
                <tbody>
                <tr v-for="(inventory,index) in latestInventories" :key="index">
                    <th scope="row">{{ index + 1 }}</th>
                    <td>{{ inventory.title }}</td>
                    <td>{{ inventory.description }}</td>
                    <td>{{ inventory.creator }}</td>
                </tr>
                </tbody>
            </table>
        </div>
        <small class="d-block text-end mt-3 d-none">
            <a href="#">All inventories</a>
        </small>
    </div>
</template>

<style scoped>

</style>
