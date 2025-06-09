<script setup lang="ts">
import BaseContainer from '@/components/BaseContainer.vue';
import WorkoutForm from '@/components/workout/WorkoutForm.vue';
import type { WorkoutEditProps } from '@/types/laravel-data';
import { Head } from '@inertiajs/vue3';

type Props = WorkoutEditProps;

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
      <WorkoutForm
        method="put"
        :url="route('workouts.update', workout.id)"
        :exercises="exercises"
        :initial="{
          id: workout.id,
          title: workout.title,
          description: workout.description,
          exercises: workoutExercises,
          recurrences: recurrences,
        }"
      />
    </div>
  </BaseContainer>
</template>
