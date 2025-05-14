<script setup lang="ts">
import AppFooter from './AppFooter.vue';
import AppHeader from './AppHeader.vue';
</script>

<template>
    <div class="flex min-h-screen flex-col">
        <AppHeader />
        <main>
            <slot />
        </main>
        <AppFooter />
    </div>
</template>
