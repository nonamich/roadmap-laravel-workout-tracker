<script setup lang="ts">
import { usePage } from '@inertiajs/vue3';
import { computed, onMounted, onUnmounted, ref, useTemplateRef } from 'vue';
const wrap = useTemplateRef('wrap');
const page = usePage();
const notifications = computed(() => page.props.notifications);
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
        v-if="notifications.length"
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
      <div
        class="mb-1.5 divide-y divide-gray-100 text-sm text-gray-500 dark:divide-gray-700 dark:text-gray-400"
      >
        <a
          :href="notification.link"
          class="flex px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-700"
          v-for="notification of notifications"
          :key="notification.id"
          v-html="notification.message"
        />
        <span v-if="!notifications.length" class="flex px-4 py-3">
          No Notifications
        </span>
      </div>
    </div>
  </div>
</template>
