import { defineStore } from 'pinia'
import {
    createInventoryItem,
    deleteInventoryItems,
    fetchInventoryItems,
    updateInventoryItem
} from "../api/inventoryItems.js";

export const useInventoryItemsStore = defineStore('inventoryItems', {
    state: () => ({
        inventoryItems: [],
        loading: false,
        error: null,
        pagination: {
            page: 1,
            total: 0,
            pages: 0,
        },
    }),

    actions:{
        async loadInventoryItems({idInventory = null, search = null,page = 1}) {
            this.loading = true
            try {
                const params = {}
                if (search !== null && search.trim() !== '') {
                    params.search = search.trim()
                }
                params.page = page
                const {inventoryItems, total , pages} = await fetchInventoryItems(idInventory, params)
                this.inventoryItems = inventoryItems
                this.pagination.total = total
                this.pagination.pages = pages
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

        async removeInventoryItems(idInventory, ids) {
            try {
                await deleteInventoryItems(idInventory, ids)
                this.inventoryItems = this.inventoryItems.filter(i => !ids.includes(i.id))
            } catch (err) {
                this.error = err.message
                throw err
            }
        }


    }
})
