<script setup lang="ts">
import { router } from '@inertiajs/vue3';
import { ref, watch } from 'vue';

const search = new URLSearchParams(location.search);

const sort = ref(
  [search.get('sort_by'), search.get('sort_dir')].filter(Boolean).join(':'),
);

watch(sort, (value) => {
  const [sortBy, sortDir] = value.split(':');
  const data: Record<string, string> = Object.fromEntries(search);

  if (sortBy) {
    data.sort_by = sortBy;
  }

  if (sortDir) {
    data.sort_dir = sortDir;
  }

  router.get(location.pathname, data, {
    preserveState: true,
    preserveScroll: true,
  });
});
</script>
<template>
  <div class="mb-6 flex items-center justify-end">
    <label class="mr-2 text-gray-700 dark:text-gray-300" for="sort-select">
      Sort by:</label
    >
    <select
      id="sort-select"
      v-model="sort"
      class="rounded border-gray-300 px-3 py-2 pe-7 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100"
    >
      <option value="">Default</option>
      <option value="name:asc">Name (A-Z)</option>
      <option value="name:desc">Name (Z-A)</option>
      <option value="created_at:asc">Created At (Oldest)</option>
      <option value="created_at:desc">Created At (Newest)</option>
    </select>
  </div>
</template>
