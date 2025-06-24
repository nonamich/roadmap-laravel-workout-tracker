<script setup lang="ts">
import BaseButton from '@/components/BaseButton.vue';
import BaseContainer from '@/components/BaseContainer.vue';
import BasePagination from '@/components/BasePagination.vue';
import BaseSort from '@/components/BaseSort.vue';
import BaseTable from '@/components/BaseTable.vue';
import type { PaginatedCollection } from '@/types/laravel';
import type { ExerciseWebData } from '@/types/laravel-data';
import { Head, Link, router } from '@inertiajs/vue3';
import { route } from 'ziggy-js';

defineProps<PaginatedCollection<ExerciseWebData>>();

const deleteExercise = (id: number) => {
  if (confirm('Are you sure you want to delete this exercise?')) {
    router.delete(route('exercises.destroy', id));
  }
};
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
      <div v-if="data.length">
        <BaseSort />
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
            <div class="truncate">{{ value }}</div>
          </template>
          <template #cell-actions="{ row: exercise }">
            <div class="flex space-x-2">
              <Link
                :href="
                  route('exercises.edit', {
                    id: exercise.id,
                  })
                "
              >
                <BaseButton size="small">Edit</BaseButton>
              </Link>
              <BaseButton
                size="small"
                color="zinc"
                @click="deleteExercise(exercise.id)"
              >
                Delete
              </BaseButton>
            </div>
          </template>
        </BaseTable>
        <BasePagination :meta="meta" :links="links" />
      </div>
      <div v-else class="text-center">
        <Link :href="route('exercises.create')">
          <BaseButton> Add Exercise </BaseButton>
        </Link>
      </div>
    </div>
  </BaseContainer>
</template>
