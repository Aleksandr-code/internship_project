import axios from 'axios'

const api = axios.create({
    baseURL: '/api'
})

export const fetchTags = () => api.get('/tags').then(res => JSON.parse(res.data.tags))
