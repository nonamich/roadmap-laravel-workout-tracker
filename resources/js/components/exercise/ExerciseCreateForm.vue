<script setup lang="ts">
import ExerciseForm, { type Emits } from './ExerciseForm.vue';

defineEmits<Emits>();
</script>

<template>
  <ExerciseForm
    method="post"
    :url="route('exercises.store')"
    @success="$emit('success')"
  />
</template>
