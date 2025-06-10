<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { onMounted, onUnmounted, ref, useTemplateRef } from 'vue';
const wrap = useTemplateRef('wrap');

const isDropdownOpen = ref(false);

const handleClickOutside = (event: MouseEvent) => {
  if (
    !wrap.value ||
    !isDropdownOpen.value ||
    !(event.target instanceof HTMLElement)
  ) {
    return;
  }

  if (event.target === wrap.value || wrap.value.contains(event.target)) {
    return;
  }

  isDropdownOpen.value = false;
};

onMounted(() => {
  document.addEventListener('click', handleClickOutside);
});

onUnmounted(() => {
  document.removeEventListener('click', handleClickOutside);
});
</script>
<template>
  <div class="relative" ref="wrap">
    <button
      id="dropdownNotificationButton"
      data-dropdown-toggle="dropdownNotification"
      class="relative inline-flex cursor-pointer items-center text-center text-sm font-medium text-gray-500 hover:text-gray-900 focus:outline-none dark:text-gray-400 dark:hover:text-white"
      type="button"
      @click="isDropdownOpen = !isDropdownOpen"
    >
      <svg
        class="h-5 w-5"
        aria-hidden="true"
        xmlns="http://www.w3.org/2000/svg"
        fill="currentColor"
        viewBox="0 0 14 20"
      >
        <path
          d="M12.133 10.632v-1.8A5.406 5.406 0 0 0 7.979 3.57.946.946 0 0 0 8 3.464V1.1a1 1 0 0 0-2 0v2.364a.946.946 0 0 0 .021.106 5.406 5.406 0 0 0-4.154 5.262v1.8C1.867 13.018 0 13.614 0 14.807 0 15.4 0 16 .538 16h12.924C14 16 14 15.4 14 14.807c0-1.193-1.867-1.789-1.867-4.175ZM3.823 17a3.453 3.453 0 0 0 6.354 0H3.823Z"
        />
      </svg>
      <div
        class="absolute start-2.5 -top-0.5 block h-3 w-3 rounded-full border-2 border-white bg-red-500 dark:border-gray-900"
      ></div>
    </button>
    <div
      id="dropdownNotification"
      class="absolute right-0 z-20 min-w-100 divide-y divide-gray-100 rounded-lg bg-white shadow-sm dark:divide-gray-700 dark:bg-gray-900"
      :class="{
        hidden: !isDropdownOpen,
      }"
    >
      <div
        class="block rounded-t-lg bg-gray-50 px-4 py-3 text-center font-medium text-gray-700 dark:bg-gray-900 dark:text-white"
      >
        Notifications
      </div>
      <div class="divide-y divide-gray-100 dark:divide-gray-700">
        <a
          href="#"
          class="flex px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-700"
        >
          <div class="w-full ps-3">
            <div class="mb-1.5 text-sm text-gray-500 dark:text-gray-400">
              New message from
              <span class="font-semibold text-gray-900 dark:text-white"
                >Jese Leos</span
              >: "Hey, what's up? All set for the presentation?"
            </div>
            <div class="text-xs text-blue-600 dark:text-blue-500">
              a few moments ago
            </div>
          </div>
        </a>
      </div>
      <Link
        :href="route('notifications.index')"
        class="block rounded-b-lg bg-gray-50 py-2 text-center text-sm font-medium text-gray-900 hover:bg-gray-100 dark:bg-gray-900 dark:text-white dark:hover:bg-gray-700"
      >
        <div class="inline-flex items-center">
          <svg
            class="me-2 h-4 w-4 text-gray-500 dark:text-gray-400"
            aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg"
            fill="currentColor"
            viewBox="0 0 20 14"
          >
            <path
              d="M10 0C4.612 0 0 5.336 0 7c0 1.742 3.546 7 10 7 6.454 0 10-5.258 10-7 0-1.664-4.612-7-10-7Zm0 10a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z"
            />
          </svg>
          View all
        </div>
      </Link>
    </div>
  </div>
</template>
