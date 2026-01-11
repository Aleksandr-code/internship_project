import {api} from './api.js';

export const fetchCategories = () => api.get('/categories').then(res => res.data)
