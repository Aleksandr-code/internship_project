import { defineStore } from 'pinia'
import {fetchCategories} from "../api/categories.js";

export const useCategoryStore = defineStore('categories', {
    state: () => ({
        categories: [],
        loading: false,
        error: null
    }),

    actions:{
        async loadCategories() {
            this.loading = true
            try {
                this.categories = await fetchCategories()
            } catch (err) {
                this.error = err.message
            } finally {
                this.loading = false
            }
        }
    }
})
