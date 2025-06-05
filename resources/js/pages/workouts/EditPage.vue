<script setup lang="ts">
import BaseContainer from '@/components/BaseContainer.vue';
import WorkoutForm from '@/components/workout/WorkoutForm.vue';
import { Head } from '@inertiajs/vue3';

type Props = {
  exercises: App.Data.Exercises.ExerciseData[];
};

defineProps<Props>();
</script>

<template>
  <Head title="Add Workout" />
  <BaseContainer>
    <div class="py-16">
      <h1
        class="mb-8 text-center text-4xl font-bold text-gray-900 md:text-5xl dark:text-gray-100"
      >
        Edit Workout
      </h1>
      <WorkoutForm :exercises="exercises" />
    </div>
  </BaseContainer>
</template>
