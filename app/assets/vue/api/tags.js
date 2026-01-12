import {api} from './api.js';

export const fetchTags = (params = null) => api.get('/tags', {params : params}).then(res => res.data)
