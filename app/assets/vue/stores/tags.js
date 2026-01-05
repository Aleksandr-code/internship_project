import { defineStore } from 'pinia'
import {fetchTags} from "../api/tags.js"

export const useTagStore = defineStore('tags', {
    state: () => ({
        tags: [],
        loading: false,
        error: null
    }),

    actions:{
        async loadTags() {
            this.loading = true
            try {
                this.tags = await fetchTags()
            } catch (err) {
                this.error = err.message
            } finally {
                this.loading = false
            }
        }
    }
})
