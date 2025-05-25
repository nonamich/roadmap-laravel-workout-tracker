<script setup lang="ts">
import AuthForm from '@/Components/AuthForm.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
  <Head title="Login" />
  <div class="grid place-items-center p-5">
    <AuthForm type="login" />
  </div>
</template>
