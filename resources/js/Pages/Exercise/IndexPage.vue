<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
defineProps({
    exercises: {
        type: Array,
        required: true,
    },
});
</script>

<template>
    <Head title="Exercises" />
    <div class="py-16 md:py-24">
        <h1 class="mb-8 text-center text-4xl font-bold text-gray-900 md:text-5xl dark:text-gray-100">Exercises</h1>
    </div>
</template>
