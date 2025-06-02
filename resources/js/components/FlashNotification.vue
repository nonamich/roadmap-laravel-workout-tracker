<script setup lang="ts">
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import BaseNotification from './BaseNotification.vue';
import ExerciseCreateNotification from './exercise/ExerciseCreateNotification.vue';
import ExerciseUpdatedNotification from './exercise/ExerciseUpdatedNotification.vue';

const page = usePage();
const flash = computed(() => page.props.flash);
</script>
<template>
  <template v-if="flash">
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
    </template>
    <template v-else>
      <BaseNotification>
        {{ flash }}
      </BaseNotification>
    </template>
  </template>
</template>
