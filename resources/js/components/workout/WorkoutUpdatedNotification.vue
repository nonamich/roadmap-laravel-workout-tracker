<script setup lang="ts">
import type { WorkoutWebData } from '@/types/laravel-data';
import BaseNotification from '../BaseNotification.vue';

type Props = {
  workout: WorkoutWebData;
};

defineProps<Props>();
</script>
<template>
  <BaseNotification>
    {{ workout.title }} workout was updated!
  </BaseNotification>
</template>
