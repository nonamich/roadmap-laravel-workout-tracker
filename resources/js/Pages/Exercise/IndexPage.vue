<script setup lang="ts">
import BaseButton from '@/Components/BaseButton.vue';
import BaseContainer from '@/Components/BaseContainer.vue';
import BasePagination from '@/Components/BasePagination.vue';
import BaseTable from '@/Components/BaseTable.vue';
import { Head, Link, router } from '@inertiajs/vue3';

defineProps<{
    data: Array<Record<string, any>>;
    links: any;
}>();

const deleteExercise = (id: number) => {
    if (confirm('Are you sure you want to delete this exercise?')) {
        router.delete(`/exercises/${id}`);
    }
};
</script>

<template>
    <Head title="Exercises" />
    <BaseContainer>
        <div class="py-16 md:py-24">
            <h1 class="mb-8 text-center text-4xl font-bold text-gray-900 md:text-5xl dark:text-gray-100">
                {{ data.length ? 'Exercises' : 'No Exercises' }}
            </h1>
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
                            <BaseButton size="small" color="red" @click="deleteExercise(row.id)">Delete</BaseButton>
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
