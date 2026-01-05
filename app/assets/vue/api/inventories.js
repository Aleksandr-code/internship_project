import axios from 'axios'

const api = axios.create({
    baseURL: '/api'
})

export const fetchInventories = () => api.get('/inventory').then(res => JSON.parse(res.data.inventories))
export const fetchInventory = (id) => api.get(`/inventory/${id}`).then(res => JSON.parse(res.data.inventory))
export const createInventory = (inventory) => api.post('/inventory', inventory).then(res => JSON.parse(res.data.inventory))
export const updateInventory = (id, inventory) => api.patch(`/inventory/${id}`, inventory).then(res => JSON.parse(res.data.inventory))
export const deleteInventories = (ids) => api.delete(`/inventory`, ids).then(() => ids)
