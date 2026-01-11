import {api} from './api.js';

export const fetchInventoryItems = (idInventory) => api.get(`/inventory/${idInventory}/items`).then(res => res.data)
export const createInventoryItem = (idInventory, item) => api.post(`/inventory/${idInventory}/items`, item).then(res => res.data)
export const updateInventoryItem = (idInventory, idInventoryItem, item) => api.patch(`/inventory/${idInventory}/items/${idInventoryItem}`, item).then(res => res.data)
export const deleteInventoryItems = (idInventory, ids) => api.post(`/inventory/${idInventory}/items/destroy`, {ids: ids}).then(res => res.data)
