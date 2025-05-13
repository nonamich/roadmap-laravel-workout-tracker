<script setup lang="ts">
import BaseButton from '@/Components/BaseButton.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Welcome" />
    <div class="py-16 md:py-24">
        <div class="text-center">
            <h1 class="mb-4 text-4xl font-bold text-gray-900 md:text-5xl dark:text-gray-100">Track Your Fitness Journey</h1>
            <p class="mx-auto mb-8 max-w-2xl text-lg text-gray-600 md:text-xl dark:text-gray-300">
                Create, manage, and schedule your workout plans with ease. Track your progress and achieve your fitness goals.
            </p>
            <BaseButton href="/login">Get Started</BaseButton>
        </div>
    </div>
</template>
