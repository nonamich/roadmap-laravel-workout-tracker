<script setup lang="ts">
import BaseNotification from '../BaseNotification.vue';

type Props = {
  exercise: App.Data.ExerciseData;
};

defineProps<Props>();
</script>
<template>
  <BaseNotification>
    {{ exercise.name }} exercise was updated!
  </BaseNotification>
</template>
