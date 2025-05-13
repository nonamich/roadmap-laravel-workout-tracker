<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { computed, defineProps } from 'vue';

interface Props {
    color?: 'primary' | 'secondary';
    size?: 'small' | 'normal';
    href?: string;
}

const { href = '', color = 'primary', size = 'normal' } = defineProps<Props>();
const tag = computed(() => (href ? 'a' : 'button'));
const isLink = computed(() => tag.value === 'a');
const sizeClassMap = computed<Record<NonNullable<Props['size']>, string>>(() => ({
    small: 'py-2 px-3 rounded-md text-sm font-bold',
    normal: 'py-4 px-6 rounded-lg font-bold text-md',
}));
const colorClassMap = computed<Record<NonNullable<Props['color']>, string>>(() => ({
    primary: 'bg-blue-600 hover:bg-blue-700',
    secondary: 'bg-amber-600 hover:bg-amber-700',
}));
</script>

<template>
    <component
        :is="isLink ? Link : 'button'"
        :href="isLink ? href : undefined"
        class="inline-block transform cursor-pointer text-center align-middle text-white shadow-md transition duration-300 ease-in-out active:scale-95 disabled:pointer-events-none disabled:opacity-55"
        :class="[colorClassMap[color], sizeClassMap[size]]"
    >
        <slot />
    </component>
</template>
