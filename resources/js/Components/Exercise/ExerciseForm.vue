<script setup lang="ts">
import BaseButton from '@/Components/BaseButton.vue';
import type { Method } from '@inertiajs/core';
import { useForm } from '@inertiajs/vue3';

interface Props {
    url: string;
    method: Method;
    initial?: {
        name: string;
        category: string;
        description: string;
    };
}

const props = defineProps<Props>();
const form = useForm({
    name: props.initial?.name || '',
    category: props.initial?.category || '',
    description: props.initial?.description || '',
});
</script>

<template>
    <form
        @submit.prevent="
            form.submit({
                method: props.method,
                url: props.url,
            })
        "
    >
        <div class="mx-auto max-w-2xl px-4 sm:px-6 lg:px-8">
            <div class="rounded-xl bg-white p-8 shadow-md dark:bg-black/30">
                <div class="mb-6">
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Name <span class="text-red-600">*</span>
                    </label>
                    <input
                        id="name"
                        type="text"
                        v-model="form.name"
                        class="mt-1 block w-full rounded-md border border-gray-300 px-4 py-2 shadow-sm focus:border-blue-600 focus:ring-blue-600 sm:text-sm dark:border-gray-800 dark:bg-black/20"
                        placeholder="Enter name"
                        required
                    />
                    <div v-if="form.errors.name" v-text="form.errors.name" class="mt-1 text-xs text-red-500" />
                </div>
                <div class="mb-6">
                    <label for="category" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Category <span class="text-red-600">*</span>
                    </label>
                    <input
                        id="category"
                        type="text"
                        v-model="form.category"
                        class="mt-1 block w-full rounded-md border border-gray-300 px-4 py-2 shadow-sm focus:border-blue-600 focus:ring-blue-600 sm:text-sm dark:border-gray-800 dark:bg-black/20"
                        placeholder="Enter category"
                        required
                    />
                    <div v-if="form.errors.category" v-text="form.errors.category" class="mt-1 text-xs text-red-500" />
                </div>
                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                    <textarea
                        id="description"
                        v-model="form.description"
                        rows="3"
                        class="mt-1 block w-full rounded-md border border-gray-300 px-4 py-2 shadow-sm focus:border-blue-600 focus:ring-blue-600 sm:text-sm dark:border-gray-800 dark:bg-black/20"
                        placeholder="Enter workout description"
                    ></textarea>
                    <div v-if="form.errors.description" v-text="form.errors.description" class="mt-1 text-xs text-red-500" />
                </div>
                <div class="flex justify-center">
                    <BaseButton type="submit">Submit</BaseButton>
                </div>
            </div>
        </div>
    </form>
</template>
