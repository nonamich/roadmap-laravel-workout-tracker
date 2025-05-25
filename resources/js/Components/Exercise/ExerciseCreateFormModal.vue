<script setup lang="ts">
import { VueFinalModal } from 'vue-final-modal';
import ExerciseCreateForm from './ExerciseCreateForm.vue';
import { type Emits } from './ExerciseForm.vue';

type Schedule = {
  name: string;
  days: string[];
  time: string;
};

type Props = {
  initial?: Schedule;
};

defineProps<Props>();
defineEmits<
  Emits & {
    close: [];
  }
>();
</script>
<template>
  <VueFinalModal content-class="h-full">
    <div class="flex h-full items-center justify-center">
      <div
        class="relative z-1 w-full max-w-md rounded bg-white p-8 shadow-lg dark:bg-gray-800"
      >
        <ExerciseCreateForm @success="$emit('success')" />
      </div>
      <div
        class="absolute inset-0 cursor-pointer"
        @click="$emit('close')"
      ></div>
    </div>
  </VueFinalModal>
</template>
