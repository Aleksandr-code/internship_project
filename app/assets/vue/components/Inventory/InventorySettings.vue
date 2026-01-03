<script setup>
import Multiselect from 'vue-multiselect'
import {ref} from 'vue'

const tagValue = ref([])
const tagOption = ref([{id: 1, title: 'test'},{id: 2, title: 'new tag'}])

const addTag = (newTag) => {
    console.log(newTag)
    const tag = { title: newTag }
    tagOption.value.push(tag)
    tagValue.value.push(tag)
}

const removeTag = (tag) => {
    console.log(tag.id)
}
</script>

<template>
    <div>
        <label for="titleInventory" class="form-label">Title</label>
        <input type="text" id="titleInventory" class="form-control">
    </div>
    <div>
        <label for="descriptionInventory" class="form-label">Description</label>
        <textarea class="form-control" id="descriptionInventory"></textarea>
    </div>
    <div>
        <label for="categoryInventory" class="form-label">Category</label>
        <select class="form-select" id="categoryInventory" aria-label="Default select example">
            <option selected>General</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
        </select>
    </div>
    <div>
        <label for="tagsInventory" class="form-label">Tags</label>
        <multiselect v-model="tagValue" open-direction="bottom" :options="tagOption" track-by="id" label="title" :multiple="true" :taggable="true" @tag="addTag" @remove="removeTag"></multiselect>
    </div>
    <div>
        <label for="imgInventory" class="form-label">Image</label>
        <div class="input-group mb-3">
            <input type="file" class="form-control" id="imgInventory">
            <label class="input-group-text" for="imgInventory">Upload</label>
        </div>
    </div>
</template>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style scoped>

</style>
