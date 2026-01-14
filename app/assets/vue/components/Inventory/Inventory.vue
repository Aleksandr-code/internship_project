<script setup>
import {onMounted, ref} from 'vue'
import { useRoute } from 'vue-router'
import InventoryItems from "./InventotyItems/InventoryItems.vue";
import InventorySettings from "./InventorySettings.vue";
import InventoryFields from "./InventoryFields.vue";
import InventoryItemsCustomID from "./InventoryItemsCustomID.vue";
import {useInventoryFieldsStore} from "../../stores/inventoryFields.js";

defineProps({
    id: {
        type: [String, Number],
        required: false
    }
})

const route = useRoute()

const activeTab = ref(1)

const setActiveTab = (tabIndex) => {
    activeTab.value = tabIndex
}

onMounted(() => {
    if (route.hash === '#settings'){
        activeTab.value = 3
    }
    if (route.hash === '#fields'){
        activeTab.value = 5
    }
})

</script>

<template>
    <h4 class="mb-3">Inventory page</h4>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link" :class="{ active: activeTab === 1 }" data-toggle="tab" href="#items" @click="setActiveTab(1)">Items</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" :class="{ active: activeTab === 2 }" data-toggle="tab" href="#chat" @click="setActiveTab(2)">Chat</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" :class="{ active: activeTab === 3 }" data-toggle="tab" href="#settings" @click="setActiveTab(3)">Settings</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" :class="{ active: activeTab === 4 }" data-toggle="tab" href="#custom_id" @click="setActiveTab(4)">Custom ID</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" :class="{ active: activeTab === 5 }" data-toggle="tab" href="#fields" @click="setActiveTab(5)">Fields</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" :class="{ active: activeTab === 6 }" data-toggle="tab" href="#access" @click="setActiveTab(6)">Access</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" :class="{ active: activeTab === 7 }" data-toggle="tab" href="#stats" @click="setActiveTab(7)">Stats</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" :class="{ active: activeTab === 8 }" data-toggle="tab" href="#export" @click="setActiveTab(8)">Export</a>
        </li>
    </ul>
    <div class="tab-content p-3">
        <div class="tab-pane fade" :class="{ show: activeTab === 1, active:  activeTab === 1}" id="items">
            <InventoryItems></InventoryItems>
        </div>
        <div class="tab-pane fade" :class="{ show: activeTab === 2, active:  activeTab === 2}" id="chat">
            Chat
        </div>
        <div class="tab-pane fade" :class="{ show: activeTab === 3, active:  activeTab === 3}" id="settings">
            <InventorySettings></InventorySettings>
        </div>
        <div class="tab-pane fade" :class="{ show: activeTab === 4, active:  activeTab === 4}" id="custom_id">
            <InventoryItemsCustomID></InventoryItemsCustomID>
        </div>
        <div class="tab-pane fade" :class="{ show: activeTab === 5, active:  activeTab === 5}" id="fields">
            <InventoryFields></InventoryFields>
        </div>
        <div class="tab-pane fade" :class="{ show: activeTab === 6, active:  activeTab === 6}" id="access">
            Access
        </div>
        <div class="tab-pane fade" :class="{ show: activeTab === 7, active:  activeTab === 7}" id="stats">
            Stats
        </div>
        <div class="tab-pane fade" :class="{ show: activeTab === 8, active:  activeTab === 8}" id="export">
            Export
        </div>
    </div>
</template>

<style scoped>

</style>
