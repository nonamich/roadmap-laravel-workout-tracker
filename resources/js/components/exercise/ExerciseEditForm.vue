<script setup lang="ts">
import ExerciseForm from './ExerciseForm.vue';

type Props = {
  exercise: App.Data.Exercises.ExerciseData;
};

defineProps<Props>();
</script>

<template>
  <ExerciseForm
    method="put"
    :url="route('exercises.update', { id: exercise.id })"
    :initial="{
      name: exercise.name,
      category: exercise.category,
      description: exercise.description,
    }"
  />
</template>
