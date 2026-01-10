import { ref, computed, watch } from 'vue';
export function useTableSelection(allRowIdsRef) {
    const selectedIds = ref([]);

    const isAllSelected = computed(() => {
        const allIds = allRowIdsRef.value || [];
        return selectedIds.value.length === allIds.length && allIds.length > 0;
    });

    const toggleAll = () => {
        const allIds = allRowIdsRef.value || [];
        if (isAllSelected.value) {
            selectedIds.value = [];
        } else {
            selectedIds.value = [...allIds];
        }
    };

    const isActiveForSingeOperation= computed(
        () => selectedIds.value.length === 1
    );

    const isActiveForMultiOperation= computed(
        () => selectedIds.value.length > 0
    );

    return {
        selectedIds,
        isAllSelected,
        toggleAll,
        isActiveForSingeOperation,
        isActiveForMultiOperation
    };
}
