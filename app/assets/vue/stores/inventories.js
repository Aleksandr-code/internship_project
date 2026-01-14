import { defineStore } from 'pinia'
import {fetchInventories, fetchInventory, createInventory, updateInventory, deleteInventories} from '../api/inventories.js'

export const useInventoryStore = defineStore('inventories', {
    state: () => ({
        inventories: [],
        currentInventory: null,
        loading: false,
        error: null,
        pagination: {
            page: 1,
            limit: 5,
            total: 0,
            pages: 0,
        },
        sorting: {
            field: 'createdAt',
            direction: 'DESC',
        },
    }),

    actions:{
        async loadInventories({ title = null, page = 1, limit = 5, sortField = null, sortDirection = null}) {
            this.loading = true
            const field = sortField ?? this.sorting.field
            const direction = sortDirection ?? this.sorting.direction

            try {
                const params = {}
                if (title !== null && title.trim() !== '') {
                    params.title = title.trim()
                }
                params.page = page
                params.limit = limit
                params.sortBy = field
                params.sortDirection = direction

                const {inventories, total , pages} = await fetchInventories(params)
                this.inventories = inventories
                this.pagination.total = total
                this.pagination.pages = pages
            } catch (err) {
                this.error = err.message
            } finally {
                this.loading = false
            }
        },

        async loadInventory(id) {
            this.loading = true
            try {
                this.currentInventory = await fetchInventory(id)
            } catch (err) {
                this.error = err.message
            } finally {
                this.loading = false
            }
        },

        async addInventory(inventory) {
            this.error = null
            try {
                const newInventory = await createInventory(inventory)
                this.inventories.push(newInventory)
                return newInventory
            } catch (err) {
                this.error = err.response.data
                throw err
            }
        },

        async editInventory(id, inventory) {
            this.error = null
            try {
                const updated = await updateInventory(id, inventory)
                const index = this.inventories.findIndex(i => i.id === id)
                if (index !== -1) this.inventories[index] = updated
                if (this.currentInventory && this.currentInventory.id === id) {
                    this.currentInventory = updated
                }
                return updated
            } catch (err) {
                this.error = err.response.data
                throw err
            }
        },

        async removeInventories(ids) {
            try {
                await deleteInventories(ids)
                this.inventories = this.inventories.filter(i => !ids.includes(i.id))
            } catch (err) {
                this.error = err.message
                throw err
            }
        },

        setSorting(field, direction) {
            this.sorting.field = field
            this.sorting.direction = direction
        }
    }
})
