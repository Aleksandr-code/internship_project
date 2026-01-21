import {api} from './api.js'

export const fetchEditors = (idInventory) => api.get(`/inventory/${idInventory}/access`).then(res => res.data)
export const update = (idInventory, isPublic, editors) => api.patch(`/inventory/${idInventory}/access`, {isPublic: isPublic, editors: editors}).then(res => res.data)
export const deleteEditors = (idInventory, editors) => api.post(`/inventory/${idInventory}/access/destroy`, {editors: editors}).then(res => res.data)
