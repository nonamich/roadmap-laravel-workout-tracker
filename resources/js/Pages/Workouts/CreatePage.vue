<script setup lang="ts">
import BaseButton from '@/Components/BaseButton.vue';
import BaseContainer from '@/Components/BaseContainer.vue';
import BaseTable from '@/Components/BaseTable.vue';
import ExerciseCreateFormModal from '@/Components/Exercise/ExerciseCreateFormModal.vue';
import RecurringScheduleModal from '@/Components/RecurringSchedule/RecurringScheduleModal.vue';
import { getDayName, timeToDate } from '@/utils';
import { Head, useForm } from '@inertiajs/vue3';
import { computed, reactive, watch } from 'vue';
import { useModal } from 'vue-final-modal';

type Props = {
  exercises: App.Data.ExerciseData[];
};
type Schedule = App.Data.WorkoutSchedulesStoreData;
type Form = App.Data.WorkoutStoreData;
type SelectedExercise = Omit<
  App.Data.WorkoutExercisesStoreData,
  'exerciseId'
> & {
  exerciseId: '' | number;
};

const props = defineProps<Props>();
const exercises = reactive(props.exercises);
const groupedExercises = computed(() =>
  Object.groupBy(exercises, ({ category }) => category),
);

const form = useForm<Form>({
  title: '',
  description: '',
  exercises: [],
  schedules: [],
});

const selectedExercises = reactive<SelectedExercise[]>([]);

const addExercise = (exerciseId: number | '' = '') => {
  selectedExercises.push({ exerciseId, sets: 3, reps: 10 });
};

const removeExercise = (idx: number) => {
  selectedExercises.splice(idx, 1);
};

const moveSelectableExercise = (from: number, to: number) => {
  const item = selectedExercises[from];

  selectedExercises.splice(from, 1);
  selectedExercises.splice(to, 0, item);
};

const upSelectableExercise = (from: number) => {
  moveSelectableExercise(from, from - 1);
};

const downSelectableExercise = (from: number) => {
  moveSelectableExercise(from, from + 1);
};

const addSchedule = (schedule: Schedule) => {
  form.schedules.push(schedule);
};

const removeSchedule = (idx: number) => {
  form.schedules.splice(idx, 1);
};

const modalSchedule = useModal({
  component: RecurringScheduleModal,
  attrs: {
    onClose() {
      modalSchedule.patchOptions({
        attrs: {
          initial: undefined,
        },
      });

      modalSchedule.close();
    },
  },
});

const modalExercise = useModal({
  component: ExerciseCreateFormModal,
  attrs: {
    onSuccess() {
      modalExercise.close();
    },
    onClose() {
      modalExercise.patchOptions({
        attrs: {
          initial: undefined,
        },
      });

      modalExercise.close();
    },
  },
});

watch(form.schedules, () => {
  form.clearErrors('schedules');

  form.schedules.sort((a, b) => {
    return timeToDate(a.time).getTime() - timeToDate(b.time).getTime();
  });
});

watch(selectedExercises, () => {
  form.clearErrors('exercises');

  form.exercises = selectedExercises.filter(
    (item): item is App.Data.WorkoutExercisesStoreData => {
      return Boolean(item.exerciseId);
    },
  );
});
</script>

<template>
  <Head title="Add Workout" />
  <BaseContainer>
    <div class="py-16">
      <h1
        class="mb-8 text-center text-4xl font-bold text-gray-900 md:text-5xl dark:text-gray-100"
      >
        Add New Workout
      </h1>
      <form
        @submit.prevent="
          form.post(route('workouts.store'), { preserveScroll: true })
        "
      >
        <div class="px-4 sm:px-6 lg:px-8">
          <div class="rounded-xl bg-white p-8 shadow-md dark:bg-black/30">
            <div class="mb-6">
              <label
                for="workoutTitle"
                class="block text-sm font-medium text-gray-700 dark:text-gray-300"
              >
                Workout Title
                <span class="text-red-600">*</span>
              </label>
              <input
                id="workoutTitle"
                type="text"
                v-model="form.title"
                class="mt-1 block w-full rounded-md border border-gray-300 px-4 py-2 shadow-sm focus:border-blue-600 focus:ring-blue-600 sm:text-sm dark:border-gray-800 dark:bg-gray-900"
                placeholder="Enter title"
                required
              />
              <div
                v-if="form.errors.title"
                v-text="form.errors.title"
                class="mt-1 text-xs text-red-500"
              />
            </div>
            <div class="mb-6">
              <label
                for="description"
                class="block text-sm font-medium text-gray-700 dark:text-gray-300"
              >
                Description
              </label>
              <textarea
                id="description"
                v-model="form.description"
                rows="4"
                class="mt-1 block w-full rounded-md border border-gray-300 px-4 py-2 shadow-sm focus:border-blue-600 focus:ring-blue-600 sm:text-sm dark:border-gray-800 dark:bg-gray-900"
                placeholder="Enter description"
              />
              <div
                v-if="form.errors.description"
                v-text="form.errors.description"
                class="mt-1 text-xs text-red-500"
              />
            </div>
            <hr class="my-5 h-px border-0 bg-gray-200 dark:bg-gray-700" />
            <div class="mb-8">
              <div class="mb-4 flex items-center justify-between">
                <h2
                  class="text-lg font-semibold text-gray-900 dark:text-gray-100"
                >
                  Exercises
                  <div
                    v-if="form.errors.exercises"
                    v-text="form.errors.exercises"
                    class="mt-1 text-xs text-red-500"
                  />
                </h2>
                <div class="flex gap-1.5">
                  <BaseButton
                    size="small"
                    color="zinc"
                    type="button"
                    @click="
                      {
                        modalExercise.open();
                      }
                    "
                  >
                    Create Exercise
                  </BaseButton>
                </div>
              </div>
              <BaseTable
                :columns="{
                  order: 'Order',
                  name: 'Name',
                  sets: 'Sets',
                  reps: 'Reps',
                  actions: 'Actions',
                }"
                :data="selectedExercises"
              >
                <template #cell-order="{ index }">
                  <div class="flex space-x-1">
                    <BaseButton
                      @click="upSelectableExercise(index)"
                      size="small"
                      color="zinc"
                      type="button"
                      :disabled="!index"
                    >
                      ↑
                    </BaseButton>
                    <BaseButton
                      @click="downSelectableExercise(index)"
                      size="small"
                      color="zinc"
                      type="button"
                      :disabled="index === selectedExercises.length - 1"
                    >
                      ↓
                    </BaseButton>
                  </div>
                </template>
                <template #cell-name="{ row }">
                  <select
                    class="block w-full rounded-md border border-gray-300 px-3 py-2 text-sm dark:border-gray-800 dark:bg-gray-900 dark:text-gray-100"
                    required
                    v-model="row.exerciseId"
                  >
                    <option disabled value="" selected hidden>
                      Select Exercise
                    </option>
                    <optgroup
                      v-for="(group, name) of groupedExercises"
                      :key="name"
                      :label="name"
                    >
                      <option
                        v-for="exercise in group"
                        :value="exercise.id"
                        :key="exercise.id"
                      >
                        {{ exercise.name }}
                      </option>
                    </optgroup>
                  </select>
                </template>
                <template #cell-sets="{ row }">
                  <input
                    type="number"
                    min="1"
                    v-model.number="row.sets"
                    class="w-16 rounded-md border border-gray-300 px-3 py-2 text-center text-sm dark:border-gray-800 dark:bg-gray-900 dark:text-gray-100"
                    required
                  />
                </template>
                <template #cell-reps="{ row }">
                  <input
                    type="number"
                    min="1"
                    v-model.number="row.reps"
                    class="w-16 rounded-md border border-gray-300 px-3 py-2 text-center text-sm dark:border-gray-800 dark:bg-gray-900 dark:text-gray-100"
                    required
                  />
                </template>
                <template #cell-actions="{ index }">
                  <div class="flex space-x-2">
                    <BaseButton
                      size="small"
                      color="zinc"
                      @click="removeExercise(index)"
                      type="button"
                      :disabled="selectedExercises.length < 2"
                    >
                      Delete
                    </BaseButton>
                  </div>
                </template>
                <template #no-data>No Exercises</template>
              </BaseTable>
              <div class="mt-3 text-center">
                <BaseButton
                  @click="addExercise()"
                  size="small"
                  color="zinc"
                  type="button"
                >
                  + Exercise
                </BaseButton>
              </div>
            </div>
            <hr class="my-5 h-px border-0 bg-gray-200 dark:bg-gray-700" />
            <div class="mb-6">
              <div class="mb-4 flex items-center justify-between">
                <h2
                  class="text-lg font-semibold text-gray-900 dark:text-gray-100"
                >
                  Schedules
                  <div
                    v-if="form.errors.schedules"
                    v-text="form.errors.schedules"
                    class="mt-1 text-xs text-red-500"
                  />
                </h2>
                <BaseButton
                  type="button"
                  @click="
                    {
                      modalSchedule.patchOptions({
                        attrs: {
                          initial: undefined,
                          onSave: addSchedule,
                        },
                      });

                      modalSchedule.open();
                    }
                  "
                  size="small"
                  color="zinc"
                >
                  Create Schedule
                </BaseButton>
              </div>
              <BaseTable
                :columns="{
                  name: 'Name',
                  time: 'Time',
                  days: 'Days',
                  actions: 'Actions',
                }"
                :data="form.schedules"
              >
                <template #cell-days="{ row }">
                  {{ row.days.map(getDayName).join(', ') }}
                </template>
                <template #cell-actions="{ row, index }">
                  <div class="flex space-x-2">
                    <BaseButton
                      size="small"
                      type="button"
                      @click="
                        modalSchedule.patchOptions({
                          attrs: {
                            initial: {
                              days: row.days,
                              name: row.name,
                              time: row.time,
                            },
                            onSave(updatedSchedule) {
                              row.days = updatedSchedule.days;
                              row.name = updatedSchedule.name;
                              row.time = updatedSchedule.time;
                            },
                          },
                        });
                        modalSchedule.open();
                      "
                    >
                      Edit
                    </BaseButton>
                    <BaseButton
                      size="small"
                      type="button"
                      color="zinc"
                      @click="removeSchedule(index)"
                      :disabled="form.schedules.length < 2"
                    >
                      Delete
                    </BaseButton>
                  </div>
                </template>
                <template #no-data> No Schedules </template>
              </BaseTable>
            </div>
            <hr class="my-5 h-px border-0 bg-gray-200 dark:bg-gray-700" />
            <div class="flex justify-center">
              <BaseButton type="submit">Add Workout</BaseButton>
            </div>
          </div>
        </div>
      </form>
    </div>
  </BaseContainer>
</template>
