<script setup lang="ts">
import { Link, router } from '@inertiajs/vue3';
import dayjs from 'dayjs';
import { route } from 'ziggy-js';
import BaseButton from './BaseButton.vue';
import BaseTable from './BaseTable.vue';

type Props = {
  schedules: App.Data.Schedules.ScheduleData[];
};

defineProps<Props>();

const deleteSchedule = (id: number) => {
  if (!confirm()) {
    return;
  }

  router.delete(route('schedules.destroy', id));
};
</script>

<template>
  <BaseTable
    v-if="schedules.length"
    :columns="{
      time: 'Time',
      title: 'Title',
      description: 'Description',
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
    <template #cell-title="{ row }">
      <div class="truncate">{{ row.workout.title }}</div>
    </template>
    <template #cell-description="{ row }">
      <div class="truncate">{{ row.workout.description }}</div>
    </template>
    <template #cell-status="{ row }">
      <span
        class="me-2 rounded-sm px-2.5 py-0.5 text-xs font-medium"
        :class="{
          'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300':
            row.status === 'scheduled',
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
      <div class="flex space-x-2">
        <Link
          :href="
            route('schedules.edit', {
              id: row.id,
            })
          "
        >
          <BaseButton size="small">Edit</BaseButton>
        </Link>
        <BaseButton size="small" color="zinc" @click="deleteSchedule(row.id)">
          Delete
        </BaseButton>
      </div>
    </template>
  </BaseTable>
</template>
