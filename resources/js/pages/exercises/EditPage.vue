<script setup lang="ts">
import ExerciseEditForm from '@/components/exercise/ExerciseEditForm.vue';
import type { ExerciseEditProps } from '@/types/laravel-data';
import { Head } from '@inertiajs/vue3';

type Props = ExerciseEditProps;

defineProps<Props>();
</script>

<template>
  <Head title="Edit Exercise" />
  <div class="py-16 md:py-24">
    <h1
      class="mb-8 text-center text-4xl font-bold text-gray-900 md:text-5xl dark:text-gray-100"
    >
      Edit Exercise
    </h1>
    <div class="mx-auto max-w-2xl px-4 sm:px-6 lg:px-8">
      <div class="rounded-xl bg-white p-8 shadow-md dark:bg-black/30">
        <ExerciseEditForm v-bind="exercise" />
      </div>
    </div>
  </div>
</template>
