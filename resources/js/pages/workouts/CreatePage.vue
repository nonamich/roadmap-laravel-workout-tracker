<script setup lang="ts">
import BaseContainer from '@/components/BaseContainer.vue';
import WorkoutForm from '@/components/workout/WorkoutForm.vue';
import type { WorkoutCreateProps } from '@/types/laravel-data';
import { Head } from '@inertiajs/vue3';

type Props = WorkoutCreateProps;

defineProps<Props>();
</script>

<template>
  <Head title="Add Workout" />
  <BaseContainer>
    <div class="py-16">
      <h1
        class="mb-8 text-center text-4xl font-bold text-gray-900 md:text-5xl dark:text-gray-100"
      >
        Add New Workout
      </h1>
      <WorkoutForm
        method="post"
        :url="route('workouts.store')"
        :exercises="exercises"
      />
    </div>
  </BaseContainer>
</template>
