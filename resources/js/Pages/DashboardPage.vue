<script setup lang="ts">
import BaseButton from '@/Components/BaseButton.vue';
import BaseTable from '@/Components/BaseTable.vue';
</script>

<template>
    <section class="py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <h2
                class="mb-12 text-center text-3xl font-bold text-gray-900 dark:text-white"
            >
                Quick Actions
            </h2>
            <div class="flex flex-wrap justify-center gap-4">
                <BaseButton>New Workout</BaseButton>
                <BaseButton color="lime">Schedule</BaseButton>
                <BaseButton color="amber">View Reports</BaseButton>
                <BaseButton color="gray">Settings</BaseButton>
            </div>
        </div>
    </section>
    <section id="workouts" class="bg-white/3 py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <h2
                class="mb-12 text-center text-3xl font-bold text-gray-900 dark:text-white"
            >
                Upcoming Workouts
            </h2>
            <BaseTable
                :columns="{
                    datetime: 'Date & Time',
                    name: 'Workout Name',
                    duration: 'Duration',
                    actions: 'Actions',
                }"
                :data="[]"
            >
            </BaseTable>
            <div
                class="overflow-x-auto rounded-lg bg-white shadow-md dark:bg-gray-900"
            >
                <table
                    class="min-w-full divide-y divide-gray-200 dark:divide-gray-700"
                >
                    <thead class="bg-gray-50 dark:bg-gray-900">
                        <tr>
                            <th
                                scope="col"
                                class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-300 uppercase"
                            >
                                Date &amp; Time
                            </th>
                            <th
                                scope="col"
                                class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-300 uppercase"
                            >
                                Workout Name
                            </th>
                            <th
                                scope="col"
                                class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-300 uppercase"
                            >
                                Duration
                            </th>
                            <th
                                scope="col"
                                class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-300 uppercase"
                            >
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody
                        class="divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-gray-800"
                    >
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div
                                    class="text-sm font-medium text-gray-900 dark:text-white"
                                >
                                    Today, 6:00 PM
                                </div>
                                <div
                                    class="text-sm text-gray-500 dark:text-gray-400"
                                >
                                    In 3 hours
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div
                                    class="text-sm text-gray-900 dark:text-white"
                                >
                                    Upper Body Strength
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div
                                    class="text-sm text-gray-900 dark:text-white"
                                >
                                    45 min
                                </div>
                            </td>
                            <td
                                class="px-6 py-4 text-sm font-medium whitespace-nowrap"
                            >
                                <div class="flex space-x-2">
                                    <BaseButton size="small">View</BaseButton>
                                    <BaseButton size="small" color="gray"
                                        >Edit</BaseButton
                                    >
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="mt-8 flex justify-center">
                <BaseButton>View All Workouts</BaseButton>
            </div>
        </div>
    </section>
</template>
