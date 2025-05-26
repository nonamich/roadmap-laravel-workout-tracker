<script setup lang="ts">
import { getDayName } from '@/utils';
import { reactive } from 'vue';
import { VueFinalModal } from 'vue-final-modal';
import BaseButton from '../BaseButton.vue';

type Schedule = App.Data.Workouts.WorkoutRecurrenceData;

type Props = {
  initial?: Schedule;
};

const { initial = { name: '', weekdays: [], time: '' } } = defineProps<Props>();
const schedule = reactive({ ...initial });

const emit = defineEmits<{
  save: [Schedule];
  close: [];
}>();
</script>
<template>
  <VueFinalModal content-class="h-full">
    <div class="flex h-full items-center justify-center">
      <div
        class="relative z-1 w-full max-w-md rounded bg-white p-8 shadow-lg dark:bg-gray-800"
      >
        <h2 class="mb-6 text-2xl font-bold text-gray-900 dark:text-gray-100">
          Recurrences
        </h2>
        <form
          @submit.prevent="
            {
              schedule.weekdays.sort();

              emit('save', schedule);
              emit('close');
            }
          "
        >
          <div class="mb-4">
            <label class="mb-1 block text-gray-700 dark:text-gray-300">
              Name
            </label>
            <input
              v-model="schedule.name"
              type="text"
              class="w-full rounded border border-gray-300 px-3 py-2 dark:border-gray-700 dark:bg-black/20 dark:text-gray-100"
              required
            />
          </div>
          <div class="mb-4">
            <label class="mb-1 block text-gray-700 dark:text-gray-300">
              Days
            </label>
            <div class="flex flex-wrap gap-2">
              <label
                v-for="(_, index) in 7"
                :key="index"
                class="flex items-center gap-1"
              >
                <input
                  type="checkbox"
                  :value="index"
                  v-model.number="schedule.weekdays"
                  class="h-5 w-5 rounded border-gray-300 dark:border-gray-700 dark:bg-black/20"
                />
                <span class="text-sm text-gray-300">{{
                  getDayName(index)
                }}</span>
              </label>
            </div>
          </div>
          <div class="mb-6">
            <label class="mb-1 block text-gray-700 dark:text-gray-300">
              Time
            </label>
            <input
              v-model="schedule.time"
              type="time"
              class="w-full rounded border border-gray-300 px-3 py-2 dark:border-gray-700 dark:bg-black/20 dark:text-gray-100"
              required
            />
          </div>
          <div class="flex justify-end gap-2">
            <BaseButton @click="emit('close')" size="small" color="zinc">
              Cancel
            </BaseButton>
            <BaseButton size="small" type="submit">Save</BaseButton>
          </div>
        </form>
      </div>
      <div class="absolute inset-0 cursor-pointer" @click="emit('close')"></div>
    </div>
  </VueFinalModal>
</template>
