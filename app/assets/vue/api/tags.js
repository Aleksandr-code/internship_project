import {api} from './api.js';

export const fetchTags = () => api.get('/tags').then(res => JSON.parse(res.data.tags))
