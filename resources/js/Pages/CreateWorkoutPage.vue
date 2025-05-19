<script setup lang="ts">
import BaseButton from '@/Components/BaseButton.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';

const workoutName = ref('');
const description = ref('');
const date = ref('');
const time = ref('');

const availableExercises = ['Bench Press', 'Squat', 'Deadlift', 'Pull Up', 'Push Up', 'Bicep Curl', 'Tricep Extension'];

const exercises = ref([{ name: '', sets: 3, reps: 10 }]);

const addExercise = () => {
    exercises.value.push({ name: '', sets: 3, reps: 10 });
};

const removeExercise = (idx: number) => {
    exercises.value.splice(idx, 1);
};

const submitWorkout = () => {
    console.log({
        workoutName: workoutName.value,
        description: description.value,
        date: date.value,
        time: time.value,
        exercises: exercises.value,
    });
};
</script>

<template>
    <Head title="Add Workout" />
    <div class="py-16 md:py-24">
        <h1 class="mb-8 text-center text-4xl font-bold text-gray-900 md:text-5xl dark:text-gray-100">Add New Workout</h1>

        <form @submit.prevent="submitWorkout">
            <div class="mx-auto max-w-2xl px-4 sm:px-6 lg:px-8">
                <div class="rounded-xl bg-white p-8 shadow-md dark:bg-black/30">
                    <!-- Workout Name -->
                    <div class="mb-6">
                        <label for="workoutName" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Workout Name</label>
                        <input
                            id="workoutName"
                            type="text"
                            v-model="workoutName"
                            class="mt-1 block w-full rounded-md border border-gray-300 px-4 py-2 shadow-sm focus:border-blue-600 focus:ring-blue-600 sm:text-sm dark:border-gray-800 dark:bg-black/20"
                            placeholder="Enter workout name"
                            required
                        />
                    </div>

                    <!-- Description -->
                    <div class="mb-6">
                        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                        <textarea
                            id="description"
                            v-model="description"
                            rows="4"
                            class="mt-1 block w-full rounded-md border border-gray-300 px-4 py-2 shadow-sm focus:border-blue-600 focus:ring-blue-600 sm:text-sm dark:border-gray-800 dark:bg-black/20"
                            placeholder="Enter workout description"
                        ></textarea>
                    </div>

                    <hr class="my-8 h-px border-0 bg-gray-200 dark:bg-gray-700" />

                    <!-- Exercises Section -->
                    <div class="mb-8">
                        <h2 class="mb-4 text-lg font-semibold text-gray-900 dark:text-gray-100">Exercises</h2>
                        <div class="overflow-x-auto">
                            <table class="min-w-full text-sm">
                                <thead>
                                    <tr class="bg-gray-100 dark:bg-black/10">
                                        <th class="px-2 py-2 text-left font-medium text-gray-700 dark:text-gray-300">Exercise</th>
                                        <th class="px-2 py-2 text-center font-medium text-gray-700 dark:text-gray-300">Sets</th>
                                        <th class="px-2 py-2 text-center font-medium text-gray-700 dark:text-gray-300">Reps</th>
                                        <th class="px-2 py-2"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(exercise, idx) in exercises" :key="idx" class="border-b border-gray-200 dark:border-gray-700">
                                        <td class="px-2 py-2">
                                            <select
                                                v-model="exercise.name"
                                                class="block w-full rounded-md border border-gray-300 px-2 py-1 dark:border-gray-800 dark:bg-black/20 dark:text-gray-100"
                                                required
                                            >
                                                <option value="" disabled>Select exercise</option>
                                                <option v-for="ex in availableExercises" :key="ex" :value="ex">{{ ex }}</option>
                                            </select>
                                        </td>
                                        <td class="px-2 py-2 text-center">
                                            <input
                                                type="number"
                                                min="1"
                                                v-model.number="exercise.sets"
                                                class="w-16 rounded-md border border-gray-300 px-2 py-1 text-center dark:border-gray-800 dark:bg-black/20 dark:text-gray-100"
                                                required
                                            />
                                        </td>
                                        <td class="px-2 py-2 text-center">
                                            <input
                                                type="number"
                                                min="1"
                                                v-model.number="exercise.reps"
                                                class="w-16 rounded-md border border-gray-300 px-2 py-1 text-center dark:border-gray-800 dark:bg-black/20 dark:text-gray-100"
                                                required
                                            />
                                        </td>
                                        <td class="px-2 py-2 text-center">
                                            <button
                                                type="button"
                                                @click="removeExercise(idx)"
                                                class="text-red-500 hover:text-red-700"
                                                title="Remove"
                                                v-if="exercises.length > 1"
                                            >
                                                ✖
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4 flex justify-end">
                            <BaseButton type="button" @click="addExercise" class="btn-sm">+ Додати вправу</BaseButton>
                        </div>
                    </div>
                    <div class="flex justify-center">
                        <BaseButton type="submit">Add Workout</BaseButton>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>
