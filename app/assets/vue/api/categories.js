import {api} from './api.js';

export const fetchCategories = () => api.get('/categories').then(res => JSON.parse(res.data.categories))
