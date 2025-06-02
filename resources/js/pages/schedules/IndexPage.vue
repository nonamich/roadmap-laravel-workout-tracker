<script setup lang="ts">
import BaseContainer from '@/components/BaseContainer.vue';
import BasePagination from '@/components/BasePagination.vue';
import SchedulesTable from '@/components/SchedulesTable.vue';
import type { PaginatedCollection } from '@/types/laravel';
import { Head } from '@inertiajs/vue3';

defineProps<PaginatedCollection<App.Data.Schedules.ScheduleData>>();
</script>

<template>
  <Head title="Schedules" />
  <BaseContainer>
    <div class="py-16 md:py-24">
      <h1
        class="mb-8 text-center text-4xl font-bold text-gray-900 md:text-5xl dark:text-gray-100"
      >
        {{ data.length ? 'Schedules' : 'No Schedules' }}
      </h1>
      <div v-if="data.length">
        <SchedulesTable :schedules="data" />
        <BasePagination :meta="meta" :links="links" />
      </div>
    </div>
  </BaseContainer>
</template>
