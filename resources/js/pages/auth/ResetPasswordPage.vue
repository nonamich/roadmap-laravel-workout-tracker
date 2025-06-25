<script setup lang="ts">
import BaseButton from '@/components/BaseButton.vue';
import { Head, useForm } from '@inertiajs/vue3';

type Props = {
  token: string;
  email: string;
};

const props = defineProps<Props>();

const form = useForm({
  token: props.token,
  email: props.email,
  password: '',
  password_confirmation: '',
});
</script>

<template>
  <Head title="Reset password" />
  <div class="grid place-items-center p-15">
    <div class="rounded-xl bg-white shadow-lg shadow-black/10 dark:bg-black/30">
      <div class="p-8">
        <h2
          class="mb-4 text-center text-2xl font-semibold text-gray-800 dark:text-gray-100"
        >
          Reset Password
        </h2>
        <form
          class="space-y-4"
          @submit.prevent="form.post(route('password.store'))"
        >
          <div>
            <label
              for="email"
              class="block text-sm font-medium text-gray-700 dark:text-gray-100"
            >
              Password
            </label>
            <input
              autocomplete="new-password"
              autofocus
              id="password"
              name="password"
              placeholder="Password"
              required
              type="password"
              v-model="form.password"
              class="mt-1 block w-full rounded-md border border-gray-300 px-4 py-2 shadow-sm focus:border-blue-600 focus:ring-blue-600 sm:text-sm dark:border-gray-800 dark:bg-black/20"
            />
            <div
              v-if="form.errors.password"
              v-text="form.errors.password"
              class="mt-1 text-xs text-red-500"
            />
          </div>
          <div>
            <label
              for="email"
              class="block text-sm font-medium text-gray-700 dark:text-gray-100"
            >
              Confirm Password
            </label>
            <input
              autocomplete="new-password"
              autofocus
              id="password_confirmation"
              name="password_confirmation"
              placeholder="Confirm password"
              required
              type="password"
              v-model="form.password_confirmation"
              class="mt-1 block w-full rounded-md border border-gray-300 px-4 py-2 shadow-sm focus:border-blue-600 focus:ring-blue-600 sm:text-sm dark:border-gray-800 dark:bg-black/20"
            />
            <div
              v-if="form.errors.password_confirmation"
              v-text="form.errors.password_confirmation"
              class="mt-1 text-xs text-red-500"
            />
          </div>
          <BaseButton type="submit" class="w-full" :disabled="form.processing">
            <template v-if="form.processing">Loading...</template>
            <template v-else>Submit</template>
          </BaseButton>
        </form>
      </div>
    </div>
  </div>
</template>
