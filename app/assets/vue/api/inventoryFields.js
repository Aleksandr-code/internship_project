import axios from 'axios'

const api = axios.create({
    baseURL: '/api'
})

export const fetchInventoryFields = (idInventory) => api.get(`/inventory/${idInventory}/fields`).then(res => JSON.parse(res.data.inventoryFields))

export const updateInventoryFields = (idInventory, fields) => api.patch(`/inventory/${idInventory}/fields`, fields).then(res => res.data)
