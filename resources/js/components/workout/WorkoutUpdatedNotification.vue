<script setup lang="ts">
import type { WorkoutData } from '@/types/laravel-data';
import BaseNotification from '../BaseNotification.vue';

type Props = {
  workout: WorkoutData;
};

defineProps<Props>();
</script>
<template>
  <BaseNotification>
    {{ workout.title }} workout was updated!
  </BaseNotification>
</template>
