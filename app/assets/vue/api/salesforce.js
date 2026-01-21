import {api} from './api.js'

export const share = (data) => api.post('/integration/salesforce/share', {data}).then(res => res.data)
