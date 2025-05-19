<script setup lang="ts">
import ExerciseForm from '@/Components/Exercise/ExerciseForm.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Create Exercise" />
    <div class="py-16 md:py-24">
        <h1 class="mb-8 text-center text-4xl font-bold text-gray-900 md:text-5xl dark:text-gray-100">Add New Exercise</h1>
        <ExerciseForm method="post" url="/exercise" />
    </div>
</template>
