<script setup lang="ts">
import BaseButton from '@/Components/BaseButton.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';

const workoutName = ref('');
const description = ref('');
const date = ref('');
const time = ref('');

const submitWorkout = () => {
    console.log({
        workoutName: workoutName.value,
        description: description.value,
        date: date.value,
        time: time.value,
    });
};
</script>

<template>
    <Head title="Add Workout" />
    <div class="py-16 md:py-24">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
            <h1 class="mb-8 text-center text-4xl font-bold text-gray-900 md:text-5xl dark:text-gray-100">Add New Workout</h1>
            <div class="rounded-xl bg-white p-8 shadow-md dark:bg-gray-800">
                <form @submit.prevent="submitWorkout">
                    <!-- Workout Name -->
                    <div class="mb-6">
                        <label for="workoutName" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Workout Name</label>
                        <input
                            id="workoutName"
                            type="text"
                            v-model="workoutName"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:text-gray-100"
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
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:text-gray-100"
                            placeholder="Enter workout description"
                            required
                        ></textarea>
                    </div>

                    <!-- Date -->
                    <div class="mb-6">
                        <label for="date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Date</label>
                        <input
                            id="date"
                            type="date"
                            v-model="date"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:text-gray-100"
                            required
                        />
                    </div>

                    <!-- Time -->
                    <div class="mb-6">
                        <label for="time" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Time</label>
                        <input
                            id="time"
                            type="time"
                            v-model="time"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:text-gray-100"
                            required
                        />
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-center">
                        <BaseButton type="submit">Add Workout</BaseButton>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
