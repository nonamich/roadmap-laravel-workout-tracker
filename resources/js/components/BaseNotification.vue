<script setup lang="ts">
import { onMounted, ref } from 'vue';

const isVisible = ref(false);

const hideMessage = () => {
  isVisible.value = false;
};

onMounted(() => {
  isVisible.value = true;
});
</script>
<template>
  <Teleport to="body" v-if="isVisible">
    <div
      class="fixed right-5 bottom-5 z-10 flex w-full max-w-xs items-center rounded-lg bg-white p-4 text-gray-500 shadow-sm dark:bg-gray-900 dark:text-gray-400"
      role="alert"
    >
      <div class="ms-3 text-sm font-normal">
        <slot />
      </div>
      <button
        type="button"
        class="-mx-1.5 -my-1.5 ms-auto inline-flex h-8 w-8 cursor-pointer items-center justify-center rounded-lg bg-white p-1.5 text-gray-400 hover:bg-gray-100 hover:text-gray-900 focus:ring-2 focus:ring-gray-300 dark:bg-gray-800 dark:text-gray-500 dark:hover:bg-gray-700 dark:hover:text-white"
        aria-label="Close"
        @click="hideMessage"
      >
        <svg
          class="h-3 w-3"
          aria-hidden="true"
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 14 14"
        >
          <path
            stroke="currentColor"
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
          />
        </svg>
      </button>
    </div>
  </Teleport>
</template>
