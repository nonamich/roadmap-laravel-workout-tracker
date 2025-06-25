<script setup lang="ts">
import AuthForm from '@/components/AuthForm.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
  <Head title="Login" />
  <div class="grid place-items-center p-15">
    <AuthForm type="register" />
  </div>
</template>
