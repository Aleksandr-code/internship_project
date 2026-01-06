<script setup>

import {reactive} from "vue";

const customIDList = reactive([])

const addCustomID = () => {
    customIDList.push({
        type:'',
        value:'',
    })
}

const saveCustomID = () => {

}

onMounted(async() => {

})

</script>

<template>
    <div class="mb-3">Preview СustomID: </div>
    <div v-if="customIDList.length === 0" class="text-muted text-center py-4">
        No fields in customID
    </div>
    <div v-for="(item, counter) in customIDList" :key="counter" class="mb-3">
        <div class="d-flex gap-3">
            <div>
                <label :for="`typeField-${counter}`" class="form-label">Type </label>
                <select v-model="item[counter].type" class="form-select" :id="`typeField-${counter}`" required>
                    <option>Fixed text</option>
                    <option>20-bit random</option>
                    <option>32-bit random</option>
                    <option>6-digit random</option>
                    <option>9-digit random</option>
                    <option>GUID</option>
                    <option>Date/time</option>
                    <option>Sequence</option>
                </select>
            </div>
            <div class="w-25">
                <label :for="`nameField-${counter}`" class="form-label">Name Column</label>
                <input type="text" v-model="item[counter].name" :id="`nameField-${counter}`" class="form-control">
            </div>
            <div class="d-flex gap-5 form-check align-items-end pb-2">
                <label for="`stateField-${counter}`" class="form-check-label">Visible</label>
                <input class="form-check-input mb-1" type="checkbox" v-model="fields[counter].state" id="`stateField-${counter}`">
            </div>
        </div>
    </div>
    <button class="btn btn-primary" @click="addCustomID">Add field</button>
    <button class="btn btn-primary mx-3" @click="saveCustomID">Save</button>
</template>

<style scoped>

</style>
