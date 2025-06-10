<script setup lang="ts">
import BaseButton from '@/components/BaseButton.vue';
import type { ScheduleShowProps } from '@/types/laravel-data';
import { Link } from '@inertiajs/vue3';

defineProps<ScheduleShowProps>();
</script>

<template>
  <div class="mx-auto max-w-2xl py-12">
    <div class="rounded-xl bg-white p-8 shadow dark:bg-black/20">
      <h1 class="mb-6 text-3xl font-bold text-gray-900 dark:text-gray-100">
        Workout:
        <Link
          class="text-blue-500"
          :href="route('workouts.edit', schedule.workout.id)"
          >{{ schedule.workout.title }}</Link
        >
      </h1>
      <div class="mb-4">
        <span class="font-semibold text-gray-700 dark:text-gray-300"
          >Workout Description:</span
        >
        <span class="ml-2 text-gray-800 dark:text-gray-200">{{
          schedule.workout.description
        }}</span>
      </div>
      <div class="mb-4">
        <span class="font-semibold text-gray-700 dark:text-gray-300"
          >Date:</span
        >
        <span class="ml-2 text-gray-800 dark:text-gray-200">{{
          schedule.scheduled_at
        }}</span>
      </div>
      <div class="mb-4">
        <span class="font-semibold text-gray-700 dark:text-gray-300"
          >Status:</span
        >
        <span class="ml-2 text-gray-800 capitalize dark:text-gray-200">{{
          schedule.status.replace(/-/g, ' ')
        }}</span>
      </div>
      <div v-if="schedule.status === 'wait-for-action'" class="mt-8 flex gap-4">
        <Link
          method="post"
          :href="route('schedules.mark-as-done', schedule.id)"
        >
          <BaseButton color="blue">To done</BaseButton>
        </Link>
        <Link
          method="post"
          :href="route('schedules.mark-as-missed', schedule.id)"
        >
          <BaseButton color="red">To missed</BaseButton>
        </Link>
      </div>
    </div>
  </div>
</template>
