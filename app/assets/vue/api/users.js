import {api} from './api.js'

export const fetchUsers = () => api.get('/admin/users').then(res => res.data)
export const setUsersStatusBlock = (ids) => api.post(`/admin/users/block`, {ids: ids}).then(res => res.data)
export const setUsersStatusUnlock = (ids) => api.post(`/admin/users/unlock`, {ids: ids}).then(res => res.data)
export const deleteUsers = (ids) => api.post(`/admin/users/destroy`, {ids: ids}).then(res => res.data)
