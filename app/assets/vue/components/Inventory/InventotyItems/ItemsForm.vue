<script setup>
import { ref, computed, watch } from 'vue'

const props = defineProps({
    modelValue: { type: Object, required: true },
    inventoryFields: { type: Object, required: true }
})

const emit = defineEmits(['update:modelValue', 'submit', 'cancel'])

const localModel = ref({ ...props.modelValue })

watch(
    localModel,
    (newVal) => {
        emit('update:modelValue', { ...newVal })
    },
    { deep: true }
)

const activeFields = computed(() => {
    try {
        const config = props.inventoryFields
        const fields = []
        const types = ['String', 'Text', 'Int', 'File', 'Bool']

        for (const type of types) {
            const lower = type.toLowerCase()
            for (let i = 1; i <= 3; i++) {
                const state = config[`custom${type}${i}State`]
                const name = config[`custom${type}${i}Name`]
                if (state !== null && name) {
                    fields.push({
                        key: `${type}${i}`,
                        label: name,
                        type: lower,
                        valueKey: `${lower}${i}Value`
                    })
                }
            }
        }
        return fields
    } catch (e) {
        console.error('Error fields for inventoryItems:', e)
        return []
    }
})

const handleSubmit = () => emit('submit')
const onCancel = () => emit('cancel')
</script>

<template>
    <form @submit.prevent="handleSubmit">
        <div v-for="field in activeFields" :key="field.key" class="form-group">
            <label>{{ field.label }}</label>

            <input v-if="field.type === 'string'" v-model="localModel[field.valueKey]" type="text" class="form-control"/>

            <textarea v-else-if="field.type === 'text'" v-model="localModel[field.valueKey]" class="form-control" rows="3"></textarea>

            <input v-else-if="field.type === 'int'" v-model.number="localModel[field.valueKey]" type="number" class="form-control"/>

            <select v-else-if="field.type === 'bool'" v-model="localModel[field.valueKey]" class="form-control">
                <option :value="null">—</option>
                <option :value="true">Yes</option>
                <option :value="false">No</option>
            </select>

            <input  v-else-if="field.type === 'file'" v-model="localModel[field.valueKey]" type="text" placeholder="URL image" class="form-control"/>
        </div>

        <div class="form-actions mt-3 gap-3 d-flex">
            <button type="submit" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-secondary" @click="onCancel">Cancel</button>
        </div>
    </form>
</template>

<style scoped>

</style>
