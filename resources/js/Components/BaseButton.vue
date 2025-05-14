<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import TailwindcssColors from 'tailwindcss/colors';
import { computed, defineProps } from 'vue';

interface Props {
    color?: Exclude<keyof typeof TailwindcssColors, 'inherit' | 'current' | 'transparent' | 'black' | 'white'>;
    size?: 'small' | 'normal';
    href?: string;
}

const { href = '', color = 'blue', size = 'normal' } = defineProps<Props>();
const tag = computed(() => (href ? 'a' : 'button'));
const isLink = computed(() => tag.value === 'a');
const sizeClassMap = computed<Record<NonNullable<Props['size']>, string>>(() => ({
    small: 'py-2 px-3 rounded-md text-sm font-bold',
    normal: 'py-4 px-6 rounded-lg font-bold text-md',
}));
const colorClassMap = computed<Record<NonNullable<Props['color']>, string>>(() => ({
    slate: 'bg-slate-600 hover:bg-slate-700',
    gray: 'bg-gray-600 hover:bg-gray-700',
    zinc: 'bg-zinc-600 hover:bg-zinc-700',
    neutral: 'bg-neutral-600 hover:bg-neutral-700',
    stone: 'bg-stone-600 hover:bg-stone-700',
    red: 'bg-red-600 hover:bg-red-700',
    orange: 'bg-orange-600 hover:bg-orange-700',
    amber: 'bg-amber-600 hover:bg-amber-700',
    yellow: 'bg-yellow-600 hover:bg-yellow-700',
    lime: 'bg-lime-600 hover:bg-lime-700',
    green: 'bg-green-600 hover:bg-green-700',
    emerald: 'bg-emerald-600 hover:bg-emerald-700',
    teal: 'bg-teal-600 hover:bg-teal-700',
    cyan: 'bg-cyan-600 hover:bg-cyan-700',
    sky: 'bg-sky-600 hover:bg-sky-700',
    blue: 'bg-blue-600 hover:bg-blue-700',
    indigo: 'bg-indigo-600 hover:bg-indigo-700',
    violet: 'bg-violet-600 hover:bg-violet-700',
    purple: 'bg-purple-600 hover:bg-purple-700',
    fuchsia: 'bg-fuchsia-600 hover:bg-fuchsia-700',
    pink: 'bg-pink-600 hover:bg-pink-700',
    rose: 'bg-rose-600 hover:bg-rose-700',
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
