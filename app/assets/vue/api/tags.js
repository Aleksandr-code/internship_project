import {api} from './api.js';

export const fetchTags = () => api.get('/tags').then(res => res.data)
