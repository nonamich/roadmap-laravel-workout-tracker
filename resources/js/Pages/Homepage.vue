<script setup>
import Layout from '../Components/Layout.vue'
import { Head } from '@inertiajs/vue3'

defineProps({ user: Object })
</script>

<template>
    <Layout>
        <Head title="Welcome" />
        <h1 class="text-red-700">Welcome</h1>
        <p>Hello welcome to your first Inertia app!</p>
    </Layout>
</template>
