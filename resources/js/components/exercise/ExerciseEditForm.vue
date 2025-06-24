<script setup lang="ts">
import type { ExerciseWebData } from '@/types/laravel-data';
import ExerciseForm from './ExerciseForm.vue';

type Props = ExerciseWebData;

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
