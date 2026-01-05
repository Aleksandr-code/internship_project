import { defineStore } from 'pinia'
import {fetchInventories, fetchInventory, createInventory, updateInventory, deleteInventories} from '../api/inventories.js'

export const useInventoryStore = defineStore('inventories', {
    state: () => ({
        inventories: [],
        currentInventory: null,
        loading: false,
        error: null
    }),

    actions:{
        async loadInventories() {
            this.loading = true
            try {
                this.inventories = await fetchInventories()
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
            try {
                const newInventory = await createInventory(inventory)
                this.inventories.push(newInventory)
                return newInventory
            } catch (err) {
                this.error = err.message
                throw err
            }
        },

        async editInventory(id, inventory) {
            try {
                const updated = await updateInventory(id, inventory)
                const index = this.inventories.findIndex(i => i.id === id)
                if (index !== -1) this.inventories[index] = updated
                if (this.currentInventory && this.currentInventory.id === id) {
                    this.currentInventory = updated
                }
                return updated
            } catch (err) {
                this.error = err.message
                throw err
            }
        },

        async removeInventory(ids) {
            try {
                await deleteInventories(ids)
                this.inventories = this.inventories.filter(i => !ids.includes(i.id))
            } catch (err) {
                this.error = err.message
                throw err
            }
        }
    }
})
