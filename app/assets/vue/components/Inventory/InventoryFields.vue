<script setup>
import {onMounted, ref, reactive, computed} from 'vue'
import {useInventoryFieldsStore} from "../../stores/inventoryFields.js";
import {useRoute} from "vue-router";

const route = useRoute()
const inventoryFieldsStore = useInventoryFieldsStore()

const rawData = ref({
    customString1State: null, customString1Name: null,
    customString2State: null, customString2Name: null,
    customString3State: null, customString3Name: null,
    customText1State: null, customText1Name: null,
    customText2State: null, customText2Name: null,
    customText3State: null, customText3Name: null,
    customInt1State: null, customInt1Name: null,
    customInt2State: null, customInt2Name: null,
    customInt3State: null, customInt3Name: null,
    customFile1State: null, customFile1Name: null,
    customFile2State: null, customFile2Name: null,
    customFile3State: null, customFile3Name: null,
    customBool1State: null, customBool1Name: null,
    customBool2State: null, customBool2Name: null,
    customBool3State: null, customBool3Name: null
});

const typeOptions = [
    { value: 'string', label: 'String' },
    { value: 'text', label: 'Text' },
    { value: 'int', label: 'Integer' },
    { value: 'file', label: 'File' },
    { value: 'bool', label: 'Checkbox' }
];

const newField = reactive({
    type: 'string',
    name: ''
});

const activeFields = reactive([]); // все активные поля (макс. 15 = 5 типов × 3)

onMounted(async () => {
    await inventoryFieldsStore.loadInventoryFields(route.params.id)
    rawData.value = inventoryFieldsStore.inventoryFields
    parseRawData();
});

function parseRawData() {
    activeFields.length = 0; // очистить
    const typeMap = {
        string: 'String',
        text: 'Text',
        int: 'Int',
        file: 'File',
        bool: 'Bool'
    };

    for (const { value: type } of typeOptions) {
        const typeName = typeMap[type];
        for (let i = 1; i <= 3; i++) {
            const name = rawData.value[`custom${typeName}${i}Name`];
            const state = rawData.value[`custom${typeName}${i}State`];
            if (name != null && name !== '') {
                activeFields.push({
                    id: `${type}-${i}`,
                    type,
                    index: i,
                    name,
                    state: Boolean(state)
                });
            }
        }
    }
}

const canAddType = computed(() => {
    const count = activeFields.filter(f => f.type === newField.type).length;
    return count < 3;
});

function addField() {
    if (!newField.name.trim()) {
        console.log('Input name');
        return;
    }
    if (!canAddType.value) {
        console.log('Max 3 fields of this type');
        return;
    }

    const currentCount = activeFields.filter(f => f.type === newField.type).length;
    const newIndex = currentCount + 1;

    activeFields.push({
        id: `${newField.type}-${newIndex}`,
        type: newField.type,
        index: newIndex,
        name: newField.name.trim(),
        state: true
    });

    newField.name = '';
}

function removeField(id) {
    const index = activeFields.findIndex(f => f.id === id);
    if (index !== -1) {
        activeFields.splice(index, 1);
    }
}

function saveFields() {
    const payload = {};

    typeOptions.forEach(opt => {
        const typeName = opt.value.charAt(0).toUpperCase() + opt.value.slice(1);
        for (let i = 1; i <= 3; i++) {
            payload[`custom${typeName}${i}Name`] = null;
            payload[`custom${typeName}${i}State`] = null;
        }
    });

    activeFields.forEach(field => {
        const typeName = field.type.charAt(0).toUpperCase() + field.type.slice(1);
        payload[`custom${typeName}${field.index}Name`] = field.name;
        payload[`custom${typeName}${field.index}State`] = field.state || null;
    });

    console.log('Saving:', payload);
    inventoryFieldsStore.saveInventoryFields(route.params.id, payload)
    inventoryFieldsStore.loadInventoryFields(route.params.id)
}

</script>

<template>
    <div class="card p-3 mb-4">
        <div class="row g-2">
            <div class="col-md-4">
                <label class="form-label">Type</label>
                <select v-model="newField.type" class="form-select form-select-sm">
                    <option v-for="opt in typeOptions" :key="opt.value" :value="opt.value">
                        {{ opt.label }}
                    </option>
                </select>
            </div>
            <div class="col-md-5">
                <label class="form-label">Name column</label>
                <input v-model="newField.name" type="text" class="form-control form-control-sm" placeholder="Title">
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <button @click="addField" :disabled="!newField.name.trim() || !canAddType" class="btn btn-primary btn-sm w-100">
                    Add field
                </button>
            </div>
        </div>
        <div v-if="!canAddType" class="mt-2 text-danger small">
            3 fields of this type have already been added
        </div>
    </div>

    <div v-if="activeFields.length === 0" class="text-muted text-center py-4">
        No fields in inventory
    </div>

    <div v-for="field in activeFields" :key="field.id" class="card mb-2">
        <div class="card-body d-flex align-items-center">
            <div class="me-3">
                <span class="badge bg-secondary">{{ field.type }}</span>
            </div>
            <div class="flex-grow-1">
                <strong>{{ field.name }}</strong>
                <small class="d-block text-muted">Positon: {{ field.index }}</small>
            </div>
            <div class="form-check me-3">
                <input v-model="field.state" class="form-check-input" type="checkbox" :id="`state-${field.id}`">
                <label :for="`state-${field.id}`" class="form-check-label">Visible</label>
            </div>
            <button @click="removeField(field.id)" class="btn btn-sm btn-outline-danger">
                Delete
            </button>
        </div>
    </div>

    <button v-if="activeFields.length > 0" @click="saveFields" class="btn btn-primary mt-3">
        Save
    </button>

</template>

<style scoped>

</style>
