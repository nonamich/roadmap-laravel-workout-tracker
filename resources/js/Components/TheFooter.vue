<script setup lang="ts">
import AppContainer from './BaseContainer.vue';

const fullYear = new Date().getFullYear();
</script>

<template>
    <footer class="mt-auto bg-gray-800 py-12 text-white">
        <AppContainer>
            <div class="flex flex-col items-center justify-between md:flex-row">
                <div class="flex items-center">
                    <p class="text-gray-300">
                        FitTrack
                        <span class="text-gray-500">
                            | Tracking your fitness journey since
                            {{ fullYear }}
                        </span>
                    </p>
                </div>
                <p class="mt-4 text-gray-500 md:mt-0">
                    © {{ fullYear }} FitTrack. All rights reserved.
                </p>
            </div>
        </AppContainer>
    </footer>
</template>
