<script setup lang="ts">
import { Link, useForm } from '@inertiajs/vue3';
import { computed } from 'vue';
import BaseButton from './BaseButton.vue';

interface Props {
    type: 'register' | 'login';
}

const { type } = defineProps<Props>();
const isLogin = computed(() => type === 'login');
const form = useForm(type, {
    name: '',
    email: '',
    password: '',
    remember: false,
});
</script>

<template>
    <div class="rounded-xl bg-white shadow-lg shadow-black/10 dark:bg-black/30">
        <div class="p-8">
            <h2 class="mb-4 text-center text-2xl font-semibold text-gray-800 dark:text-gray-100">
                {{ isLogin ? 'Login' : 'Register' }}
            </h2>
            <form class="space-y-4" @submit.prevent="form.post(isLogin ? '/login' : '/register')">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-100">Email</label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        required
                        autofocus
                        v-model="form.email"
                        class="mt-1 block w-full rounded-md border border-gray-300 px-4 py-2 shadow-sm focus:border-blue-600 focus:ring-blue-600 sm:text-sm dark:border-gray-800 dark:bg-black/20"
                    />
                    <div v-if="form.errors.email" v-text="form.errors.email" class="mt-1 text-xs text-red-500" />
                </div>
                <div v-if="!isLogin">
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-100">Name</label>
                    <input
                        id="name"
                        type="text"
                        name="name"
                        required
                        v-model="form.name"
                        class="mt-1 block w-full rounded-md border border-gray-300 px-4 py-2 shadow-sm focus:border-blue-600 focus:ring-blue-600 sm:text-sm dark:border-gray-800 dark:bg-black/20"
                    />
                    <div v-if="form.errors.name" v-text="form.errors.name" class="mt-1 text-xs text-red-500" />
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-100">Password</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        minlength="8"
                        required
                        v-model="form.password"
                        class="mt-1 block w-full rounded-md border border-gray-300 px-4 py-2 shadow-sm focus:border-blue-600 focus:ring-blue-600 sm:text-sm dark:border-gray-800 dark:bg-black/20"
                    />
                    <div v-if="form.errors.password" v-text="form.errors.password" class="mt-1 text-xs text-red-500" />
                </div>
                <div>
                    <div class="flex items-center justify-between gap-3">
                        <div class="flex items-start">
                            <div class="flex h-5 items-center">
                                <input
                                    id="remember"
                                    name="remember"
                                    type="checkbox"
                                    v-model="form.remember"
                                    class="h-5 w-5 rounded border-gray-300 text-blue-600 focus:ring-blue-600 dark:border-gray-800 dark:bg-black/10"
                                />
                            </div>
                            <div class="ml-2 text-sm">
                                <label for="remember" class="font-medium text-gray-700 dark:text-gray-100">Remember me</label>
                            </div>
                        </div>
                        <div class="text-sm">
                            <a href="#" class="font-medium text-blue-600 hover:text-blue-600 dark:text-blue-500">Forgot password?</a>
                        </div>
                    </div>
                    <div v-if="form.errors.remember" v-text="form.errors.remember" class="mt-1 text-xs text-red-500" />
                </div>
                <BaseButton type="submit" class="w-full" :disabled="form.processing">
                    <template v-if="form.processing">Loading...</template>
                    <template v-else>Submit</template>
                </BaseButton>
            </form>
            <div class="mt-7 text-center">
                <p class="text-sm text-gray-600 dark:text-gray-200">
                    {{ isLogin ? "Don't have an account?" : 'You already have account?' }}
                    <Link :href="isLogin ? '/register' : '/login'" class="font-medium text-blue-600 hover:text-blue-600">{{
                        isLogin ? 'Sign up' : 'Sign in'
                    }}</Link>
                </p>
            </div>
        </div>
    </div>
</template>
