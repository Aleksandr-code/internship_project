import {api} from './api.js';

export const fetchInventoryFields = (idInventory) => api.get(`/inventory/${idInventory}/fields`).then(res => res.data)

export const updateInventoryFields = (idInventory, fields) => api.patch(`/inventory/${idInventory}/fields`, fields).then(res => res.data)
