<script setup lang="ts">
import AppLayout from '@/Components/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
  <Head title="Welcome" />
  <AppLayout>
    <div class="bg-gray-100 py-16 md:py-24">
      <div class="text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
          Track Your Fitness Journey
        </h1>
        <p class="text-lg md:text-xl text-gray-600 max-w-2xl mx-auto mb-8">
          Create, manage, and schedule your
          workout plans with ease. Track your progress and achieve your fitness goals.
        </p>
        <button
          class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg shadow-md transition duration-300 ease-in-out transform hover:scale-105"
        >
          Get Started
        </button>
      </div>
    </div>
  </AppLayout>
</template>
