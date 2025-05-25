<script setup lang="ts">
import { ModalsContainer } from 'vue-final-modal';
import FlashNotification from './FlashNotification.vue';
import AppFooter from './TheFooter.vue';
import TheHeader from './TheHeader.vue';
</script>

<template>
  <div class="flex min-h-screen flex-col">
    <TheHeader />
    <main>
      <slot />
    </main>
    <AppFooter />
  </div>
  <ModalsContainer />
  <FlashNotification />
</template>
