<script setup lang="ts">
import { usePage } from '@inertiajs/vue3';
import { computed, ref, watch } from 'vue';
import BaseNotification from './BaseNotification.vue';
import ExerciseCreateNotification from './exercise/ExerciseCreateNotification.vue';
import ExerciseUpdatedNotification from './exercise/ExerciseUpdatedNotification.vue';
import WorkoutUpdatedNotification from './workout/WorkoutUpdatedNotification.vue';

const page = usePage();
const flash = computed(() => page.props.flash);
const flashKey = ref<number>(0);

watch(
  flash,
  () => {
    flashKey.value = Date.now();
  },
  {
    immediate: true,
  },
);
</script>
<template>
  <div v-if="flash" :key="flashKey">
    <template
      v-if="
        typeof flash === 'object' &&
        flash.props &&
        typeof flash.props === 'object' &&
        !Array.isArray(flash.props)
      "
    >
      <ExerciseCreateNotification
        v-if="flash.component === 'exercise-created'"
        v-bind="flash.props"
      />
      <ExerciseUpdatedNotification
        v-else-if="flash.component === 'exercise-updated'"
        v-bind="flash.props"
      />
      <WorkoutUpdatedNotification
        v-else-if="flash.component === 'workout-updated'"
        v-bind="flash.props"
      />
    </template>
    <template v-else>
      <BaseNotification>
        {{ flash }}
      </BaseNotification>
    </template>
  </div>
</template>
