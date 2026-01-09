import {api} from './api.js'

export const login = (email, password) => api.post('/auth/login', {email, password}).then(res => res.data)
export const register = (email, password) => api.post('/auth/register', {email, password}).then(res => res.data)
export const me = () => api.post('/auth/me').then(res => res.data)
