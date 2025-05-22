<script setup lang="ts">
import { ModalsContainer } from 'vue-final-modal';
import AppFooter from './TheFooter.vue';
import AppHeader from './TheHeader.vue';
</script>

<template>
    <div class="flex min-h-screen flex-col">
        <AppHeader />
        <main>
            <slot />
        </main>
        <AppFooter />
    </div>
    <ModalsContainer />
</template>
