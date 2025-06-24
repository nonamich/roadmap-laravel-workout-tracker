<script setup lang="ts">
import type { ExerciseWebData } from '@/types/laravel-data';
import { Link } from '@inertiajs/vue3';
import BaseNotification from '../BaseNotification.vue';

type Props = {
  exercise: ExerciseWebData;
};

defineProps<Props>();
</script>
<template>
  <BaseNotification>
    <Link
      class="text-blue-500 underline"
      :href="route('exercises.edit', [exercise.id])"
    >
      {{ exercise.name }}
    </Link>
    exercise was created!
  </BaseNotification>
</template>
