<script setup>
import { ref, reactive } from 'vue';
import {share} from '../api/salesforce.js';

const formData = reactive({
    firstName: '',
    lastName: '',
    email: '',
    companyName: '',
    phone:''
});

const loading = ref(false);
const submitted = ref(false);
const result = ref(null);
const error = ref('');

const submitForm = async () => {
    loading.value = true;
    error.value = '';

    try {
        const data = await share(formData);
        if (data) {
            submitted.value = true;
            result.value = data;
        } else {
            error.value = data.error || 'Submitting error';
        }
        console.log(data)
    } catch (err) {
        console.log(err);
        error.value = err.response?.data?.error || 'Error';
    } finally {
        loading.value = false;
    }
};
</script>

<template>
    <div>Salesforce integration</div>
    <div class="salesforce-form col-6">
        <h2>Share information with Salesforce service</h2>

        <form @submit.prevent="submitForm" v-if="!submitted">
            <div class="mb-3">
                <label>Company Name:</label>
                <input class="form-control" v-model="formData.companyName" placeholder="abc@company" required />
            </div>
            <div class="d-flex gap-3 mb-3">
                <div>
                    <label>First Name:</label>
                    <input class="form-control" v-model="formData.firstName" placeholder="Mr."/>
                </div>
                <div>
                    <label>Last Name:</label>
                    <input class="form-control" v-model="formData.lastName" placeholder="Black" required />
                </div>
            </div>
            <div class="mb-3 w-50">
                <label>Phone:</label>
                <input type="tel" class="form-control" v-model="formData.phone" placeholder="+7 505 233 23 23" required/>
            </div>

            <button class="btn btn-primary" type="submit" :disabled="loading">
                {{ loading ? 'Submitting...' : 'Share' }}
            </button>
        </form>

        <div v-else class="success-message">
            ✅ Shared Data is OK!
        </div>

        <div v-if="error" class="error">{{ error }}</div>
    </div>
</template>

<style scoped>

</style>
