<script setup lang="ts">
import { VueFinalModal } from 'vue-final-modal';
import ExerciseCreateForm from './ExerciseCreateForm.vue';

type Schedule = {
    name: string;
    days: string[];
    time: string;
};

type Props = {
    initial?: Schedule;
};

const { initial = { name: '', days: [], time: '' } } = defineProps<Props>();
// const schedule = reactive(initial);
defineEmits<{
    save: [Schedule];
    close: void;
}>();
</script>
<template>
    <VueFinalModal content-class="h-full">
        <div class="flex h-full items-center justify-center">
            <div
                class="relative z-1 w-full max-w-md rounded bg-white p-8 shadow-lg dark:bg-gray-800"
            >
                <ExerciseCreateForm />
            </div>
            <div
                class="absolute inset-0 cursor-pointer"
                @click="$emit('close')"
            ></div>
        </div>
    </VueFinalModal>
</template>
