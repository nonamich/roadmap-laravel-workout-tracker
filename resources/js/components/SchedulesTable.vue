<script setup lang="ts">
import type { ScheduleData } from '@/types/laravel-data';
import { Link } from '@inertiajs/vue3';
import dayjs from 'dayjs';
import { route } from 'ziggy-js';
import BaseButton from './BaseButton.vue';
import BaseTable from './BaseTable.vue';

type Props = {
  schedules: ScheduleData[];
};

defineProps<Props>();
</script>

<template>
  <BaseTable
    v-if="schedules.length"
    :columns="{
      time: 'Time',
      workout: 'Workout',
      status: 'Status',
      actions: 'Actions',
    }"
    :data="schedules"
  >
    <template #cell-time="{ row }">
      <div class="text-sm font-medium">
        {{ dayjs(row.scheduled_at).format('ddd, MMM D, h:mm A') }}
      </div>
      <div class="text-sm text-gray-400 first-letter:uppercase">
        {{ dayjs(row.scheduled_at).fromNow() }}
      </div>
    </template>
    <template #cell-workout="{ row }">
      <div class="truncate">
        <Link
          :href="route('workouts.show', row.workout.id)"
          class="text-blue-500 hover:underline"
        >
          {{ row.workout.title }}
        </Link>
      </div>
    </template>
    <template #cell-status="{ row }">
      <span
        class="me-2 rounded-sm px-2.5 py-0.5 text-xs font-medium"
        :class="{
          'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300':
            row.status === 'scheduled',
          'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300':
            row.status === 'wait-for-action',
          'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300':
            row.status === 'missed',
          'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300':
            row.status === 'done',
        }"
      >
        {{ row.status.toUpperCase() }}
      </span>
    </template>
    <template #cell-actions="{ row }">
      <div
        class="flex place-items-center space-x-2"
        v-if="row.status === 'wait-for-action'"
      >
        <Link method="post" :href="route('schedules.mark-as-done', row.id)">
          <BaseButton size="small" color="emerald">Done</BaseButton>
        </Link>
        <span class="text-gray-400">- or -</span>
        <Link method="post" :href="route('schedules.mark-as-missed', row.id)">
          <BaseButton size="small" color="rose">Miss</BaseButton>
        </Link>
      </div>
    </template>
  </BaseTable>
</template>
