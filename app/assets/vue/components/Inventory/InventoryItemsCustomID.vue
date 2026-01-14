<script setup>

import {ref} from "vue";

const customIDList = ref([])

const addCustomID = () => {
    customIDList.value.push({
        type:'',
        value:'',
    })
}

const saveCustomID = () => {

}

</script>

<template>
    <h2 class="text-danger">No work</h2>
    <div class="mb-3">Preview СustomID: </div>
    <div v-if="customIDList.length === 0" class="text-muted my-4">
        No fields in customID
    </div>
    <div v-for="(item, counter) in customIDList" :key="counter" class="mb-3">
        <div class="d-flex gap-3">
            <div>
                <label :for="`typeField-${counter}`" class="form-label">Type </label>
                <select class="form-select" :id="`typeField-${counter}`" required>
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
                <input type="text" :id="`nameField-${counter}`" class="form-control">
            </div>
            <div class="d-flex gap-5 form-check align-items-end pb-2">
                <label for="`stateField-${counter}`" class="form-check-label">Visible</label>
                <input class="form-check-input mb-1" type="checkbox" id="`stateField-${counter}`">
            </div>
        </div>
    </div>
    <button class="btn btn-primary" @click="addCustomID">Add field</button>
    <button class="btn btn-primary mx-3" @click="saveCustomID">Save</button>
</template>

<style scoped>

</style>
