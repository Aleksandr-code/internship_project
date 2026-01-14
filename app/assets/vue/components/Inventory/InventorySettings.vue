<script setup>
import Multiselect from 'vue-multiselect'
import {onMounted, ref, computed} from 'vue'
import {useInventoryStore} from "../../stores/inventories.js";
import {useCategoryStore} from "../../stores/categories.js";
import {useTagStore} from "../../stores/tags.js";
import {useRouter, useRoute} from "vue-router";

const route = useRoute()
const storeInventory = useInventoryStore()
const storeCategory = useCategoryStore()
const storeTag = useTagStore()

const tagValue = ref([])

const inventory = ref({
    title:'',
    description: '',
    image_url: '',
    category_id: 1,
    tags_id: [],
    created_at: '',
    is_public: 0,
})

const addTag = (newTag) => {
    console.log(newTag)
    const tag = { title: newTag }
    storeTag.tags.push(tag)
    tagValue.value.push(tag)
}

const openTags = async () => {
    await storeTag.loadTags()
    console.log(storeTag.tags)
}

const removeTag = (tag) => {
    console.log(tag.id)
}

const submitInventory = async() => {
    inventory.value.created_at = new Date()
    inventory.value.tags_id = tagValue.value.map(tag => tag.id)
    try {
        const updatedInventory = await storeInventory.editInventory(route.params.id, inventory.value)
        console.log('update inventory ok')
    } catch (err) {
        console.log(err)
    }
}

onMounted(async () => {
    await storeCategory.loadCategories()
    await storeInventory.loadInventory(route.params.id)
    if(storeInventory.currentInventory){
        inventory.value.title = storeInventory.currentInventory.title
        inventory.value.description = storeInventory.currentInventory.description
        inventory.value.image_url = storeInventory.currentInventory.imageUrl
        inventory.value.category_id = storeInventory.currentInventory.category.id
        tagValue.value = storeInventory.currentInventory.tags
        inventory.value.created_at = storeInventory.currentInventory.createdAt
        inventory.value.is_public = storeInventory.currentInventory.isPublic
    }
})

</script>

<template>
    <div>
        <label for="titleInventory" class="form-label">Title</label>
        <input type="text" v-model="inventory.title" id="titleInventory" class="form-control">
        <p class="text-danger" v-if="storeInventory.error?.title">{{ storeInventory.error.title[0] }}</p>
    </div>
    <div>
        <label for="descriptionInventory" class="form-label">Description</label>
        <textarea v-model="inventory.description" class="form-control" id="descriptionInventory"></textarea>
        <p class="text-danger" v-if="storeInventory.error?.description">{{ storeInventory.error.description[0] }}</p>
    </div>
    <div>
        <label for="categoryInventory" class="form-label">Category</label>
        <select v-model="inventory.category_id" class="form-select" id="categoryInventory">
            <option v-for="category in storeCategory.categories" :key="category.id" :value="category.id">
                {{category.title}}
            </option>
        </select>
    </div>
    <div>
        <label for="tagsInventory" class="form-label">Tags</label>
        <multiselect v-model="tagValue" @open="openTags" :options="storeTag.tags" :loading="storeTag.loading" open-direction="bottom"  track-by="id" label="title" :multiple="true" :taggable="true" @tag="addTag" @remove="removeTag"></multiselect>
    </div>
    <div>
        <label for="imgInventory" class="form-label">Image</label>
        <div class="input-group mb-3">
            <input v-model="inventory.image_url" type="url" class="form-control" id="imgInventory" placeholder="https://site.com/image.jpg">
            <label class="input-group-text" for="imgInventory">Upload</label>
        </div>
        <p class="text-danger" v-if="storeInventory.error?.imageUrl">{{ storeInventory.error.imageUrl[0] }}</p>
    </div>
    <button class="btn btn-primary" @click="submitInventory">Save</button>
</template>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style scoped>

</style>
