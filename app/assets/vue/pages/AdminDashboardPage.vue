<script setup>
import {ref, onMounted, computed} from "vue";
import {fetchUsers, setUsersStatusBlock, setUsersStatusUnlock, deleteUsers} from '../api/users.js'
import {useTableSelection} from "../composables/useTableSelection.js";

const loading = ref(false)
const error = ref(null)
const users = ref([])
const loadData = async () => {
    loading.value = true
    try {
        const data = await fetchUsers()
        console.log(data)
        users.value = data
    }
    catch (err){
        error.value = err
    }
    finally {
        loading.value = false
    }
}

const formatStatus = (isBlocked) => {
    if (isBlocked === 0){
        return 'Active'
    }
    return 'Blocked'
}

const itemIds = computed(() => users.value.map(i => i.id));
const { selectedIds, isAllSelected, toggleAll, isActiveForMultiOperation } = useTableSelection(itemIds);

const handleCheckBoxToggle = (id, event) => {
    const checked = event.target.checked;
    if (checked) {
        selectedIds.value.push(id);
    } else {
        selectedIds.value = selectedIds.value.filter(i => i !== id);
    }
};

const handleBlock = async (ids) => {
    await setUsersStatusBlock(ids)
    await loadData()
}

const handleUnlock= async (ids) => {
    await setUsersStatusUnlock(ids)
    await loadData()
}

const handleDelete= async (ids) => {
    await deleteUsers(ids)
    await loadData()
}

onMounted(() => {
    loadData()
})
</script>

<template>
    <div>AdminPage</div>
    <hr>
    <div class="d-flex justify-content-between mb-4" id="toolbar">
        <div class="d-flex gap-2">
            <button class="btn btn-outline-primary" :disabled="!isActiveForMultiOperation" @click="handleBlock(selectedIds)">Blocked</button>
            <button class="btn btn-outline-primary" :disabled="!isActiveForMultiOperation" @click="handleUnlock(selectedIds)">Unlock</button>
            <button class="btn btn-outline-danger" :disabled="!isActiveForMultiOperation" @click="handleDelete(selectedIds)">Delete</button>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead class="table-light">
            <tr>
                <th scope="col">
                    <input type="checkbox" :checked="isAllSelected" @change="toggleAll"/>
                </th>
                <th scope="col">Email</th>
                <th scope="col">Status</th>
                <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody v-if="loading">
            <tr >Loading...</tr>
            </tbody>
            <tbody v-else-if="error">
            <tr> Error loaded data</tr>
            </tbody>
            <tbody v-else>
            <tr v-for="user in users" :key="user.id">
                <th scope="row">
                    <input
                        type="checkbox"
                        :checked="selectedIds.includes(user.id)"
                        @change="handleCheckBoxToggle(user.id, $event)">
                </th>
                <td>{{ user.email }}</td>
                <td>{{ formatStatus(user.isBlocked) }}</td>
                <td>{{ user.roles[0] }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<style scoped>

</style>
