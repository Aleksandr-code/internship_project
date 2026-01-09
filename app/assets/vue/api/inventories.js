import {api} from './api.js';

export const fetchInventories = () => api.get('/inventory').then(res => res.data)
export const fetchInventory = (id) => api.get(`/inventory/${id}`).then(res => res.data)
export const createInventory = (inventory) => api.post('/inventory', inventory).then(res => res.data)
export const updateInventory = (id, inventory) => api.patch(`/inventory/${id}`, inventory).then(res => res.data)
export const deleteInventories = (ids) => api.delete(`/inventory`, ids).then(() => ids)
