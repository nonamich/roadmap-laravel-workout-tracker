<script setup lang="ts">
import type { PaginatedCollection } from '@/types/laravel';
import { Link } from '@inertiajs/vue3';

type Props = Omit<PaginatedCollection, 'data'>;

defineProps<Props>();
</script>

<template>
  <div
    v-if="meta.last_page > 1"
    id="pagination"
    class="flex w-full items-center justify-center pt-4"
  >
    <div class="flex flex-wrap">
      <template v-for="(link, key) in links" :key="key">
        <Link
          v-if="link.url"
          class="mr-1 mb-1 rounded border border-gray-700 px-4 py-3 text-sm leading-4 font-bold hover:border-blue-600 hover:bg-blue-600"
          :class="{
            'pointer-events-none border-blue-600 bg-blue-600 text-white':
              link.active,
          }"
          :href="link.url"
        >
          <span v-html="link.label" />
        </Link>
      </template>
    </div>
  </div>
</template>
