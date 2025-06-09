<script setup lang="ts">
import type { ExerciseData } from '@/types/laravel-data';
import ExerciseForm from './ExerciseForm.vue';

type Props = ExerciseData;

defineProps<Props>();
</script>

<template>
  <ExerciseForm
    method="put"
    :url="route('exercises.update', { id })"
    :initial="{
      name,
      category,
      description,
    }"
  />
</template>
