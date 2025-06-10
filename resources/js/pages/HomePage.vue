<script setup lang="ts">
import BaseButton from '@/components/BaseButton.vue';
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
  <Head title="Welcome" />
  <div class="py-16 md:py-24">
    <div class="text-center">
      <h1
        class="mb-4 text-4xl font-bold text-gray-900 md:text-5xl dark:text-gray-100"
      >
        Track Your Fitness Journey
      </h1>
      <p
        class="mx-auto mb-8 max-w-2xl text-lg text-gray-600 md:text-xl dark:text-gray-300"
      >
        Create, manage, and schedule your workout plans with ease. Track your
        progress and achieve your fitness goals.
      </p>
      <Link :href="$page.props.user ? route('dashboard.show') : route('login')">
        <BaseButton>Get Started</BaseButton>
      </Link>
    </div>
  </div>
  <section id="features" class="bg-black/10 py-16">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <h2
        class="mb-12 text-center text-3xl font-bold text-gray-900 dark:text-gray-100"
      >
        Key Features
      </h2>

      <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
        <!-- Feature 1 -->
        <div
          class="overflow-hidden rounded-xl bg-white shadow-md transition-shadow duration-300 hover:shadow-lg dark:bg-black/20"
        >
          <div class="p-6">
            <h3
              class="mb-3 text-center text-xl font-semibold text-gray-900 dark:text-white"
            >
              Create Workouts
            </h3>
            <p class="mb-4 text-center text-gray-600 dark:text-gray-400">
              Design custom workout plans with multiple exercises, sets, reps,
              and weights.
            </p>
            <div class="flex justify-center">
              <BaseButton size="small">Create Now</BaseButton>
            </div>
          </div>
        </div>

        <!-- Feature 2 -->
        <div
          class="overflow-hidden rounded-xl bg-white shadow-md transition-shadow duration-300 hover:shadow-lg dark:bg-black/20"
        >
          <div class="p-6">
            <h3
              class="mb-3 text-center text-xl font-semibold text-gray-900 dark:text-white"
            >
              Update Workouts
            </h3>
            <p class="mb-4 text-center text-gray-600 dark:text-gray-400">
              Modify your workout plans and add comments to track your progress.
            </p>
            <div class="flex justify-center">
              <BaseButton size="small">Update</BaseButton>
            </div>
          </div>
        </div>

        <!-- Feature 3 -->
        <div
          class="overflow-hidden rounded-xl bg-white shadow-md transition-shadow duration-300 hover:shadow-lg dark:bg-black/20"
        >
          <div class="p-6">
            <h3
              class="mb-3 text-center text-xl font-semibold text-gray-900 dark:text-white"
            >
              Schedule Workouts
            </h3>
            <p class="mb-4 text-center text-gray-600 dark:text-gray-400">
              Plan your workouts for specific dates and times to stay on track.
            </p>
            <div class="flex justify-center">
              <BaseButton size="small">Schedule</BaseButton>
            </div>
          </div>
        </div>

        <!-- Feature 4 -->
        <div
          class="overflow-hidden rounded-xl bg-white shadow-md transition-shadow duration-300 hover:shadow-lg dark:bg-black/20"
        >
          <div class="p-6">
            <h3
              class="mb-3 text-center text-xl font-semibold text-gray-900 dark:text-white"
            >
              List Workouts
            </h3>
            <p class="mb-4 text-center text-gray-600 dark:text-gray-400">
              View all your active and pending workouts sorted by date and time.
            </p>
            <div class="flex justify-center">
              <BaseButton size="small">View List</BaseButton>
            </div>
          </div>
        </div>

        <!-- Feature 5 -->
        <div
          class="overflow-hidden rounded-xl bg-white shadow-md transition-shadow duration-300 hover:shadow-lg dark:bg-black/20"
        >
          <div class="p-6">
            <h3
              class="mb-3 text-center text-xl font-semibold text-gray-900 dark:text-white"
            >
              Delete Workouts
            </h3>
            <p class="mb-4 text-center text-gray-600 dark:text-gray-400">
              Remove workout plans that you no longer need or want to use.
            </p>
            <div class="flex justify-center">
              <BaseButton size="small">Manage</BaseButton>
            </div>
          </div>
        </div>

        <!-- Feature 6 -->
        <div
          class="overflow-hidden rounded-xl bg-white shadow-md transition-shadow duration-300 hover:shadow-lg dark:bg-black/20"
        >
          <div class="p-6">
            <h3
              class="mb-3 text-center text-xl font-semibold text-gray-900 dark:text-white"
            >
              Generate Reports
            </h3>
            <p class="mb-4 text-center text-gray-600 dark:text-gray-400">
              Track your progress with detailed reports on past workouts and
              achievements.
            </p>
            <div class="flex justify-center">
              <BaseButton size="small">View Reports</BaseButton>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
