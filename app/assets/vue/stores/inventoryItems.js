import { defineStore } from 'pinia'
import {
    createInventoryItem,
    deleteInventoryItems,
    fetchInventoryItems,
    updateInventoryItem
} from "../api/inventoryItems.js";
import {deleteInventories} from "../api/inventories.js";

export const useInventoryItemsStore = defineStore('inventoryItems', {
    state: () => ({
        inventoryItems: [],
        loading: false,
        error: null
    }),

    actions:{
        async loadInventoryItems(idInventory) {
            this.loading = true
            try {
                this.inventoryItems = await fetchInventoryItems(idInventory)
            } catch (err) {
                this.error = err.message
            } finally {
                this.loading = false
            }
        },

        async addInventoryItem(idInventory, item) {
            try {
                const newItem = await createInventoryItem(idInventory, item)
                this.inventoryItems.push(newItem)
                return newItem
            } catch (err) {
                this.error = err.message
                throw err
            }
        },

        async updateInventoryItem(idInventory, item) {
            try {
                const updated = await updateInventoryItem(idInventory, item.id, item)
                const index = this.inventoryItems.findIndex(i => i.id === item.id)
                if (index !== -1) this.inventoryItems[index] = updated
                return updated
            } catch (err) {
                this.error = err.message
                throw err
            }
        },

        async removeInventoryItems(ids) {
            try {
                await deleteInventoryItems(ids)
                this.inventoryItems = this.inventoryItems.filter(i => !ids.includes(i.id))
            } catch (err) {
                this.error = err.message
                throw err
            }
        }


    }
})
