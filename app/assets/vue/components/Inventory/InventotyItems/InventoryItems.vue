<script setup>
import { ref, computed, onMounted } from 'vue'
import ItemsForm from "./ItemsForm.vue";
import {useInventoryItemsStore} from "../../../stores/inventoryItems.js";
import {useInventoryFieldsStore} from "../../../stores/inventoryFields.js";
import {useRoute} from "vue-router";
import {useTableSelection} from "../../../composables/useTableSelection.js";

const viewMode = ref('table') // 'table' | 'create' | 'edit'
const currentItem = ref({})

const inventoryItemsStore = useInventoryItemsStore()
const inventoryFieldsStore = useInventoryFieldsStore()
const route = useRoute()

const fetchInventoryData = async () => {
    await inventoryFieldsStore.loadInventoryFields(route.params.id)

    await inventoryItemsStore.loadInventoryItems(
        {idInventory: route.params.id,
                                search:null,
                                page: 1})
}

const columns = computed(() => {
    try {
        const config = inventoryFieldsStore.inventoryFields
        const cols = []
        const types = ['String', 'Text', 'Int', 'File', 'Bool']

        for (const type of types) {
            const lower = type.toLowerCase()
            for (let i = 1; i <= 3; i++) {
                const state = config[`custom${type}${i}State`]
                const name = config[`custom${type}${i}Name`]
                if (state !== null && name) {
                    cols.push({
                        key: `${type}${i}`,
                        label: name,
                        type: lower,
                        valueKey: `${lower}${i}Value`
                    })
                }
            }
        }
        return cols
    } catch (e) {
        console.log('Error columns:', e)
        return []
    }
})

const formatValue = (value, type) => {
    if (value === null || value === undefined) return '—'
    if (type === 'bool') return value ? '✅' : '❌'
    return String(value)
}

const createEmptyItem = () => ({
    createdAt: new Date().toISOString(),
    string1Value: null,
    string2Value: null,
    string3Value: null,
    text1Value: null,
    text2Value: null,
    text3Value: null,
    int1Value: null,
    int2Value: null,
    int3Value: null,
    file1Value: null,
    file2Value: null,
    file3Value: null,
    bool1Value: null,
    bool2Value: null,
    bool3Value: null
})

const startCreate = () => {
    currentItem.value = createEmptyItem()
    viewMode.value = 'create'
}

const startEdit = (item) => {
    currentItem.value = { ...item }
    viewMode.value = 'edit'
}

const startEditByID = (id) => {
    const item = inventoryItemsStore.inventoryItems.find(item => item.id === id);
    currentItem.value = { ...item }
    viewMode.value = 'edit'
}

const handleAddItem = () => {
    currentItem.value.created_at = new Date()
    inventoryItemsStore.addInventoryItem(route.params.id, currentItem.value)
    loadData(inventoryItemsStore.pagination.page)
    viewMode.value = 'table'
}

const handleEditItem = () => {
    inventoryItemsStore.updateInventoryItem(route.params.id, currentItem.value)
    viewMode.value = 'table'
}

const handleDeleteItems = (ids) => {
    inventoryItemsStore.removeInventoryItems(route.params.id, ids)
}

// MultiOperation with table
const itemIds = computed(() => inventoryItemsStore.inventoryItems.map(i => i.id));
const { selectedIds, isAllSelected, toggleAll, isActiveForSingeOperation, isActiveForMultiOperation } = useTableSelection(itemIds);

const handleCheckBoxToggle = (id, event) => {
    const checked = event.target.checked;
    if (checked) {
        selectedIds.value.push(id);
    } else {
        selectedIds.value = selectedIds.value.filter(i => i !== id);
    }
};

// search
let debounceTimer = null
const searchInput = ref('')

const loadData = async (page = 1) => {
    await inventoryItemsStore.loadInventoryItems({
        idInventory: route.params.id,
        search: searchInput.value || null,
        page,
    })
}
const searchChange = () => {
    clearTimeout(debounceTimer)
    debounceTimer = setTimeout(() => {
        loadData(1)
    }, 300)
}

const changePage = (page) => {
    inventoryItemsStore.pagination.page = page
    loadData(page)
}

onMounted(() => {
    fetchInventoryData()
})

</script>

<template>
    <div v-if="viewMode === 'table'">
        <div class="d-flex justify-content-between mb-4" id="toolbar">
            <div class="d-flex gap-2">
                <button class="btn btn-outline-primary" @click="startCreate">Add Item</button>
                <button
                    class="btn btn-outline-primary"
                    :disabled="!isActiveForSingeOperation"
                    @click="startEditByID(selectedIds[0])">
                    Edit
                </button>
                <button class="btn btn-outline-danger"
                        :disabled="!isActiveForMultiOperation"
                        @click="handleDeleteItems(selectedIds)">
                    Delete
                </button>
            </div>
            <div class="d-flex gap-3">
                <input v-model="searchInput" @input="searchChange" class="form-control" type="search" placeholder="Search by table">
            </div>
        </div>
        <div v-if="columns.length" class="table-responsive">
            <table class="table">
                <thead class="table-light">
                    <tr>
                        <th>
                            <input type="checkbox" :checked="isAllSelected" @change="toggleAll">
                        </th>
                        <th v-for="col in columns" :key="col.key">{{ col.label }}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in inventoryItemsStore.inventoryItems" :key="index">
                        <td>
                            <input
                                type="checkbox"
                                :checked="selectedIds.includes(item.id)"
                                @change="handleCheckBoxToggle(item.id, $event)">
                        </td>
                        <td v-for="col in columns" :key="col.key">
                            {{ formatValue(item[col.valueKey], col.type) }}
                        </td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary" @click="startEdit(item)">
                                Edit
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <p v-else>No active fields</p>
        <div v-if="inventoryItemsStore.pagination.pages > 1" class="pagination my-3 mx-3 d-flex justify-content-between">
            <div>
                <button
                    class="btn btn-outline-primary"
                    :disabled="inventoryItemsStore.pagination.page <= 1"
                    @click="changePage(inventoryItemsStore.pagination.page - 1)">
                    Back
                </button>
                <span class="mx-2">Page {{ inventoryItemsStore.pagination.page }} of {{ inventoryItemsStore.pagination.pages }}</span>
                <button
                    class="btn btn-outline-primary"
                    :disabled="inventoryItemsStore.pagination.page >= inventoryItemsStore.pagination.pages"
                    @click="changePage(inventoryItemsStore.pagination.page + 1)">
                    Next
                </button>
            </div>
            <div>
                Total {{inventoryItemsStore.pagination.total}}
            </div>
        </div>
    </div>

    <div v-else-if="viewMode === 'create'" class="form-view">
        <h2>New Item</h2>
        <ItemsForm v-model="currentItem"
                   :inventory-fields="inventoryFieldsStore.inventoryFields"
                   @submit="handleAddItem"
                   @cancel="viewMode = 'table'">
        </ItemsForm>
    </div>

    <div v-else-if="viewMode === 'edit'" class="form-view">
        <h2>Edit item</h2>
        <ItemsForm v-model="currentItem"
                   :inventory-fields="inventoryFieldsStore.inventoryFields"
                   @submit="handleEditItem"
                   @cancel="viewMode = 'table'">
        </ItemsForm>
    </div>

</template>

<style scoped>

</style>
