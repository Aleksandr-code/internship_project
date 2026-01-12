<script setup>
import {ref, onMounted} from "vue";
import {fetchTopInventories} from "../../api/inventories.js";

const topInventories = ref([]);
async function loadData(){
    try {
        topInventories.value = await fetchTopInventories()
    } catch (e){
        console.log(e)
    }
}

onMounted(() => {
    loadData()
})
</script>

<template>
    <div class="my-3 p-3 bg-body rounded shadow-sm col-md-6 mx-auto">
        <h4 class="border-bottom pb-2 mb-0 text-uppercase">Top 5 popular inventories</h4>
        <div class="table-responsive">
            <table class="table">
                <thead class="table-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Inventory</th>
                    <th scope="col">Count items</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(inventory, index) in topInventories" :key="index">
                    <th scope="row">{{ index + 1 }}</th>
                    <td>{{ inventory.inventory }}</td>
                    <td>{{ inventory.itemsCount}}</td>
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
