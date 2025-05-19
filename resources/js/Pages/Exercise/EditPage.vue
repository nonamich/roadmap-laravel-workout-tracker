<script setup lang="ts">
import ExerciseForm from '@/Components/Exercise/ExerciseForm.vue';
import { Head } from '@inertiajs/vue3';
defineProps({
    exercise: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <Head title="Edit Exercise" />
    <div class="py-16 md:py-24">
        <h1 class="mb-8 text-center text-4xl font-bold text-gray-900 md:text-5xl dark:text-gray-100">Edit Exercise</h1>
        <ExerciseForm
            method="put"
            :url="`/exercises/${exercise.id}`"
            :initial="{
                name: exercise.name,
                category: exercise.category,
                description: exercise.description,
            }"
        />
    </div>
</template>
