<script lang="ts" setup>
const model = defineModel<boolean>();
</script>

<template>
    <Teleport to="body" v-if="model">
        <div
            v-if="model"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/60"
        >
            <div
                class="relative z-1 w-full max-w-md rounded bg-white p-8 shadow-lg dark:bg-gray-800"
            >
                <h2
                    v-if="$slots.heading"
                    class="mb-6 text-2xl font-bold text-gray-900 dark:text-gray-100"
                >
                    <slot name="heading" />
                </h2>
                <slot />
            </div>
            <div
                class="absolute inset-0 cursor-pointer"
                @click="model = false"
            ></div>
        </div>
    </Teleport>
</template>
