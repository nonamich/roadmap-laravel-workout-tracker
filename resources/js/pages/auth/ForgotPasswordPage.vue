<script setup lang="ts">
import BaseButton from '@/components/BaseButton.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

type Props = {
  status?: string;
};

defineProps<Props>();

const form = useForm({
  email: '',
});
</script>

<template>
  <Head title="Forgot Password" />
  <div class="grid place-items-center p-15">
    <div class="rounded-xl bg-white shadow-lg shadow-black/10 dark:bg-black/30">
      <div class="p-8">
        <h2
          class="mb-4 text-center text-2xl font-semibold text-gray-800 dark:text-gray-100"
        >
          Forgot Password
        </h2>

        <div
          v-if="status"
          class="mb-4 text-center text-sm font-medium text-green-600"
        >
          {{ status }}
        </div>
        <form
          class="space-y-4"
          @submit.prevent="form.post(route('password.email'))"
        >
          <div>
            <label
              for="email"
              class="block text-sm font-medium text-gray-700 dark:text-gray-100"
              >Email address</label
            >
            <input
              id="email"
              type="email"
              name="email"
              required
              autofocus
              v-model="form.email"
              class="mt-1 block w-full rounded-md border border-gray-300 px-4 py-2 shadow-sm focus:border-blue-600 focus:ring-blue-600 sm:text-sm dark:border-gray-800 dark:bg-black/20"
            />
            <div
              v-if="form.errors.email"
              v-text="form.errors.email"
              class="mt-1 text-xs text-red-500"
            />
          </div>
          <BaseButton type="submit" class="w-full" :disabled="form.processing">
            <template v-if="form.processing">Loading...</template>
            <template v-else>Submit</template>
          </BaseButton>
        </form>

        <div
          class="mt-7 space-x-1 text-center text-sm text-gray-600 dark:text-gray-400"
        >
          <span>Or, return to</span>
          <Link
            class="font-medium text-blue-600 hover:text-blue-600"
            :href="route('login')"
            >log in</Link
          >
        </div>
      </div>
    </div>
  </div>
</template>
