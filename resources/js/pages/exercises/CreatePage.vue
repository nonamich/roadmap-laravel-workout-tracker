<script setup lang="ts">
import ExerciseCreateForm from '@/components/exercise/ExerciseCreateForm.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
  <Head title="Create Exercise" />
  <div class="py-16 md:py-24">
    <h1
      class="mb-8 text-center text-4xl font-bold text-gray-900 md:text-5xl dark:text-gray-100"
    >
      Add New Exercise
    </h1>
    <div class="mx-auto max-w-2xl px-4 sm:px-6 lg:px-8">
      <div class="rounded-xl bg-white p-8 shadow-md dark:bg-black/30">
        <ExerciseCreateForm />
      </div>
    </div>
  </div>
</template>
