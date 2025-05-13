<script setup lang="ts">
import Container from './AppContainer.vue';
import AppFooter from './AppFooter.vue';
import AppHeader from './AppHeader.vue';
</script>

<template>
    <AppHeader />
    <main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <Container>
            <slot />
        </Container>
    </main>
    <AppFooter />
</template>
