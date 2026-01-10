<script setup>
import { useInventoryStore } from '../../stores/inventories.js'
import {computed, onMounted} from "vue";
import { useTableSelection } from '../../composables/useTableSelection.js';
import {useRouter} from 'vue-router'

const store = useInventoryStore()
const router = useRouter()

const itemIds = computed(() => store.inventories.map(i => i.id));
const { selectedIds, isAllSelected, toggleAll, isActiveForSingeOperation, isActiveForMultiOperation } = useTableSelection(itemIds);

const handleCheckBoxToggle = (id, event) => {
    const checked = event.target.checked;
    if (checked) {
        selectedIds.value.push(id);
    } else {
        selectedIds.value = selectedIds.value.filter(i => i !== id);
    }
    console.log(selectedIds.value)
};

const handleEdit = () => {
    router.push({name: 'inventory_show', params: {id: selectedIds.value[0]}, hash: '#settings'})
}

const handleDelete = () => {
    store.removeInventories(selectedIds.value)
}

onMounted(() => {
    store.loadInventories()
})
</script>

<template>
    <h3>My inventories</h3>
    <hr>
    <div class="d-flex justify-content-between mb-4" id="toolbar">
        <div class="d-flex gap-2">
            <router-link class="btn btn-outline-primary" :to="{name: 'inventory_create'}">Add Inventory</router-link>
            <button class="btn btn-outline-primary" :disabled="!isActiveForSingeOperation" @click="handleEdit">Edit</button>
            <button class="btn btn-outline-danger" :disabled="!isActiveForMultiOperation" @click="handleDelete">Delete</button>
        </div>
        <div class="d-flex gap-3">
            <input class="form-control" type="search" placeholder="Search by table">
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Sorted by
                    <i class="bi bi-arrow-down-up"></i>
                </button>
                <ul class="dropdown-menu">
                    <li><button class="dropdown-item" type="button">Title <i class="bi bi-arrow-down-short"></i></button></li>
                    <li><button class="dropdown-item" type="button">Title <i class="bi bi-arrow-up-short"></i></button></li>
                    <li><button class="dropdown-item" type="button">Created at <i class="bi bi-arrow-down-short"></i></button></li>
                    <li><button class="dropdown-item" type="button">Created at <i class="bi bi-arrow-up-short"></i></button></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead class="table-light">
            <tr>
                <th scope="col">
                    <input type="checkbox" :checked="isAllSelected" @change="toggleAll"/>
                </th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Category</th>
                <th scope="col">Access</th>
                <th scope="col">Created at</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody v-if="store.loading">
                <tr >Loading...</tr>
            </tbody>
            <tbody v-else-if="store.error">
                <tr> Error loaded data</tr>
            </tbody>
            <tbody v-else>
            <tr v-for="inventory in store.inventories" :key="inventory.id">
                <th scope="row">
                    <input
                        type="checkbox"
                        :checked="selectedIds.includes(inventory.id)"
                        @change="handleCheckBoxToggle(inventory.id, $event)">
                </th>
                <td>
                    <router-link :to="{name: 'inventory_show', params: {id: inventory.id}}">{{inventory.title}}</router-link>
                </td>
                <td>{{inventory.description}}</td>
                <td>{{inventory.category.title}}</td>
                <td>{{inventory.isPublic}}</td>
                <td>{{inventory.createdAt}}</td>
                <td>
                    <router-link class="btn btn-warning" :to="{name: 'inventory_show', params: {id: inventory.id}, hash: '#settings'}">Edit</router-link>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<style scoped>

</style>
