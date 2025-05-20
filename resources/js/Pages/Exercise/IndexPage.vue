<script setup lang="ts">
import BaseButton from '@/Components/BaseButton.vue';
import BaseContainer from '@/Components/BaseContainer.vue';
import BasePagination from '@/Components/BasePagination.vue';
import BaseTable from '@/Components/BaseTable.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { ref, watch } from 'vue';

const props = defineProps<{
    data: Array<Record<string, any>>;
    links: any;
    // eslint-disable-next-line vue/prop-name-casing
    current_page: number;
}>();
const search = new URLSearchParams(location.search);

const sort = ref(
    [search.get('sort_by'), search.get('sort_dir')].filter(Boolean).join(':'),
);

const deleteExercise = (id: number) => {
    if (confirm('Are you sure you want to delete this exercise?')) {
        router.delete(`/exercises/${id}`);
    }
};

watch(sort, (value) => {
    const [sortBy, sortDir] = value.split(':');

    router.get(
        location.pathname,
        { page: props.current_page, sort_by: sortBy, sort_dir: sortDir },
        { preserveState: true, preserveScroll: true },
    );
});
</script>

<template>
    <Head title="Exercises" />
    <BaseContainer>
        <div class="py-16 md:py-24">
            <h1
                class="mb-8 text-center text-4xl font-bold text-gray-900 md:text-5xl dark:text-gray-100"
            >
                {{ data.length ? 'Exercises' : 'No Exercises' }}
            </h1>
            <div class="mb-6 flex items-center justify-end">
                <label
                    class="mr-2 text-gray-700 dark:text-gray-300"
                    for="sort-select"
                    >Sort by:</label
                >
                <select
                    id="sort-select"
                    v-model="sort"
                    class="rounded border-gray-300 px-3 py-2 pe-7 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100"
                >
                    <option value="">Default</option>
                    <option value="name:asc">Name (A-Z)</option>
                    <option value="name:desc">Name (Z-A)</option>
                    <option value="created_at:asc">Created At (Oldest)</option>
                    <option value="created_at:desc">Created At (Newest)</option>
                </select>
            </div>
            <div v-if="data.length">
                <BaseTable
                    v-if="data.length"
                    :columns="{
                        name: 'Name',
                        category: 'Category',
                        description: 'Description',
                        actions: 'Actions',
                    }"
                    :data="data"
                >
                    <template #cell-description="{ value }">
                        <div class="w-64 truncate">{{ value }}</div>
                    </template>
                    <template #cell-actions="{ row }">
                        <div class="flex space-x-2">
                            <Link :href="`/exercises/${row.id}/edit`">
                                <BaseButton size="small">Edit</BaseButton>
                            </Link>
                            <BaseButton
                                size="small"
                                color="zinc"
                                @click="deleteExercise(row.id)"
                                >Delete</BaseButton
                            >
                        </div>
                    </template>
                </BaseTable>
                <BasePagination :links="links" />
            </div>
            <div v-else class="text-center">
                <BaseButton href="/exercises/create">Add Exercise</BaseButton>
            </div>
        </div>
    </BaseContainer>
</template>
