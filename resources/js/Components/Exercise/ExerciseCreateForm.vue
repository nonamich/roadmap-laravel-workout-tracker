<script setup lang="ts">
import ExerciseForm from './ExerciseForm.vue';
</script>

<template>
    <ExerciseForm method="post" :url="route('exercises.store')" />
</template>
