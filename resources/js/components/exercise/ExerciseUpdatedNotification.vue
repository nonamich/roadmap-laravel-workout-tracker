<script setup lang="ts">
import type { ExerciseWebData } from '@/types/laravel-data';
import BaseNotification from '../BaseNotification.vue';

type Props = {
  exercise: ExerciseWebData;
};

defineProps<Props>();
</script>
<template>
  <BaseNotification>
    {{ exercise.name }} exercise was updated!
  </BaseNotification>
</template>
