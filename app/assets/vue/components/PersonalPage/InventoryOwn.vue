<script setup>
import { useInventoryStore } from '../../stores/inventories.js'
import {ref, computed, onMounted} from "vue";
import { useTableSelection } from '../../composables/useTableSelection.js';
import {useRouter} from 'vue-router'

const store = useInventoryStore()
const router = useRouter()

const itemIds = computed(() => store.inventories.map(i => i.id));
const { selectedIds, isAllSelected, toggleAll, isActiveForSingeOperation, isActiveForMultiOperation } = useTableSelection(itemIds);

let debounceTimer = null

const searchInput = ref('')
const loadData = async (page = 1) => {
    await store.loadInventories({
        title: searchInput.value || null,
        page,
        limit: 5,
        sortField: store.sorting.field,
        sortDirection: store.sorting.direction,
    })
}

const handleCheckBoxToggle = (id, event) => {
    const checked = event.target.checked;
    if (checked) {
        selectedIds.value.push(id);
    } else {
        selectedIds.value = selectedIds.value.filter(i => i !== id);
    }
    console.log(selectedIds.value)
};

const formatDate = (isoString) => {
    return new Date(isoString).toLocaleDateString()
}

const changePage = (page) => {
    store.pagination.page = page
    loadData(page)
}

const searchChange = () => {
    clearTimeout(debounceTimer)
    debounceTimer = setTimeout(() => {
        loadData(1)
    }, 300)
}

const applySorting = (field, direction) => {
    store.setSorting(field, direction)
    loadData(1)
}

const handleEdit = () => {
    router.push({name: 'inventory_show', params: {id: selectedIds.value[0]}, hash: '#settings'})
}

const handleDelete = () => {
    store.removeInventories(selectedIds.value)
}

onMounted(() => {
    loadData(1)
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
            <input v-model="searchInput" @input="searchChange" class="form-control" type="search" placeholder="Search by title">
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Sorted by
                    <i class="bi bi-arrow-down-up"></i>
                </button>
                <ul class="dropdown-menu">
                    <li>
                        <button @click="applySorting('title', 'ASC')" class="dropdown-item" type="button">
                            <i v-show="store.sorting.field === 'title' && store.sorting.direction === 'ASC'" class="bi bi-check"></i>
                            Title
                            <i class="bi bi-arrow-up-short"></i>
                        </button>
                    </li>
                    <li>
                        <button @click="applySorting('title', 'DESC')" class="dropdown-item" type="button">
                            <i v-show="store.sorting.field === 'title' && store.sorting.direction === 'DESC'" class="bi bi-check"></i>
                            Title
                            <i class="bi bi-arrow-down-short"></i>
                        </button>
                    </li>
                    <li>
                        <button @click="applySorting('createdAt', 'ASC')" class="dropdown-item" type="button">
                            <i v-show="store.sorting.field === 'createdAt' && store.sorting.direction === 'ASC'" class="bi bi-check"></i>
                            Created at
                            <i class="bi bi-arrow-up-short"></i>
                        </button>
                    </li>
                    <li>
                        <button @click="applySorting('createdAt', 'DESC')" class="dropdown-item" type="button">
                            <i v-show="store.sorting.field === 'createdAt' && store.sorting.direction === 'DESC'" class="bi bi-check"></i>
                            Created at
                            <i class="bi bi-arrow-down-short"></i>
                        </button>
                    </li>
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
                <td>{{formatDate(inventory.createdAt)}}</td>
                <td>
                    <router-link class="btn btn-warning" :to="{name: 'inventory_show', params: {id: inventory.id}, hash: '#settings'}">Edit</router-link>
                </td>
            </tr>
            </tbody>
        </table>
        <div v-if="store.pagination.pages > 1" class="pagination my-3 mx-3 d-flex justify-content-between">
            <div>
                <button
                    class="btn btn-outline-primary"
                    :disabled="store.pagination.page <= 1"
                    @click="changePage(store.pagination.page - 1)">
                    Back
                </button>
                <span class="mx-2">Page {{ store.pagination.page }} of {{ store.pagination.pages }}</span>
                <button
                    class="btn btn-outline-primary"
                    :disabled="store.pagination.page >= store.pagination.pages"
                    @click="changePage(store.pagination.page + 1)">
                    Next
                </button>
            </div>
            <div>
                Total {{store.pagination.total}}
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
