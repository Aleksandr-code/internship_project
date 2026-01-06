import { defineStore } from 'pinia'
import {fetchInventoryFields, updateInventoryFields} from "../api/inventoryFields.js"
import {updateInventory} from "../api/inventories.js";

export const useInventoryFieldsStore = defineStore('inventoryFields', {
    state: () => ({
        inventoryFields: [],
        loading: false,
        error: null
    }),

    actions:{
        async loadInventoryFields(idInventory) {
            this.loading = true
            try {
                this.inventoryFields = await fetchInventoryFields(idInventory)
            } catch (err) {
                this.error = err.message
            } finally {
                this.loading = false
            }
        },

        async saveInventoryFields(idInventory, fields) {
            try {
                const updatedMessage = await updateInventoryFields(idInventory, fields)
                console.log(updatedMessage.message)
                return updatedMessage
            } catch (err) {
                this.error = err.message
                throw err
            }
        },


    }
})
