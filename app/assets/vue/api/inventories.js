import {api} from './api.js';

export const fetchInventories = (params) => api.get('/inventory', {params: params}).then(res => res.data)
export const fetchInventory = (id) => api.get(`/inventory/${id}`).then(res => res.data)
export const createInventory = (inventory) => api.post('/inventory', inventory).then(res => res.data)
export const updateInventory = (id, inventory) => api.patch(`/inventory/${id}`, inventory).then(res => res.data)
export const deleteInventories = (ids) => api.post(`/inventory/destroy`, {ids: ids}).then(res => res.data)
export const fetchLatestInventories = () => api.get(`/inventory/latest`).then(res => res.data)
export const fetchTopInventories = () => api.get(`/inventory/top`).then(res => res.data)
