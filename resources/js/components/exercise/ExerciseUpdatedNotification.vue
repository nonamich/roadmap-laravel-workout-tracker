<script setup lang="ts">
import type { ExerciseData } from '@/types/laravel-data';
import BaseNotification from '../BaseNotification.vue';

type Props = {
  exercise: ExerciseData;
};

defineProps<Props>();
</script>
<template>
  <BaseNotification>
    {{ exercise.name }} exercise was updated!
  </BaseNotification>
</template>
