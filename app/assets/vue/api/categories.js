import axios from 'axios'

const api = axios.create({
    baseURL: '/api'
})

export const fetchCategories = () => api.get('/categories').then(res => JSON.parse(res.data.categories))
