<script setup>

import {ref} from "vue";
import axios from "axios";

const isPrivate = ref(false)
const email = ref('')
const editors = ref([])

const handleAdd = () => {
    editors.value.push({email: email.value})
    email.value = ''
    console.log('add')
}
const handleSave = () => {
    console.log('save')
}

</script>

<template>
    <div class="d-flex gap-3 mb-3">
        <span>Public</span>
        <div class="form-check form-switch">
            <input class="form-check-input" v-model="isPrivate" type="checkbox" role="switch" id="flexSwitchCheckChecked">
        </div>
        <span>Private</span>
        <button class="btn btn-primary" @click="handleSave">Save</button>
    </div>
    <div v-if="isPrivate">
        <div class="d-flex col-md-5 gap-3 mb-3">
            <input v-model="email" type="email" class="form-control" placeholder="email">
            <button class="btn btn-primary w-25" @click="handleAdd">Add user</button>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead class="table-light">
                <tr>
                    <th scope="col">Email</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody v-if="false">
                <tr >Loading...</tr>
                </tbody>
                <tbody v-else-if="false">
                <tr> Error loaded data</tr>
                </tbody>
                <tbody v-else>
                <tr v-for="editor in editors" :key="editor.id">
                    <td>{{editor.email}}</td>
                    <td></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

</template>

<style scoped>

</style>
