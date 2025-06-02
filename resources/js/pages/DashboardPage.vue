<script setup lang="ts">
import BaseButton from '@/components/BaseButton.vue';
import SchedulesTable from '@/components/SchedulesTable.vue';
import { Link } from '@inertiajs/vue3';

defineProps<App.Data.DashboardPageData>();
</script>

<template>
  <section class="py-16">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <h2
        class="mb-12 text-center text-3xl font-bold text-gray-900 dark:text-white"
      >
        Quick Actions
      </h2>
      <div class="flex flex-wrap justify-center gap-4">
        <Link :href="route('workouts.create')">
          <BaseButton>New Workout</BaseButton>
        </Link>
        <Link :href="route('schedules.index')">
          <BaseButton color="lime">Schedules</BaseButton>
        </Link>
        <Link href="#"
          ><BaseButton color="amber">View Reports</BaseButton></Link
        >
        <Link href="#"><BaseButton color="gray">Settings</BaseButton></Link>
      </div>
    </div>
  </section>
  <section id="workouts" class="bg-white/3 py-16">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <h2
        class="mb-12 text-center text-3xl font-bold text-gray-900 dark:text-white"
      >
        Upcoming Schedules
      </h2>
      <SchedulesTable :schedules="schedules" />
      <div class="mt-8 flex justify-center">
        <Link :href="route('schedules.index')">
          <BaseButton>View All Schedules</BaseButton>
        </Link>
      </div>
    </div>
  </section>
</template>
