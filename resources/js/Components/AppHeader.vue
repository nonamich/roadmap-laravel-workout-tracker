<script setup lang="ts">
import { Link, router, usePage } from '@inertiajs/vue3';
import { computed, ref, useTemplateRef, watch } from 'vue';
import Container from './AppContainer.vue';
import BaseButton from './BaseButton.vue';

const isOpenUserDropdown = ref(false);
const dropdownRef = useTemplateRef('dropdownRef');
const page = usePage();
const user = computed(() => page.props.user);

const handleClickOutside = (event: DocumentEventMap['click']) => {
    const $dropdown = dropdownRef.value;

    if (!$dropdown) {
        return;
    }

    if (event.target instanceof Element && $dropdown.contains(event.target)) {
        return;
    }

    isOpenUserDropdown.value = false;
};

watch(isOpenUserDropdown, (newVal) => {
    if (newVal) {
        document.addEventListener('click', handleClickOutside);
    } else {
        document.removeEventListener('click', handleClickOutside);
    }
});

const handleLogout = () => {
    router.flushAll();
};
</script>

<template>
    <header class="mb-3">
        <nav class="bg-blue-600 text-white shadow-md">
            <Container>
                <div class="flex h-16 justify-between">
                    <div class="flex items-center">
                        <div class="flex flex-shrink-0 items-center">
                            <Link href="/" class="text-xl font-bold">FitTrack</Link>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <div v-if="user" class="relative ml-3" ref="dropdownRef">
                            <div>
                                <button
                                    id="user-menu-button"
                                    type="button"
                                    class="flex cursor-pointer rounded-full bg-blue-500 text-sm"
                                    aria-expanded="false"
                                    aria-haspopup="true"
                                    @click="isOpenUserDropdown = !isOpenUserDropdown"
                                >
                                    <span class="sr-only">Open user menu</span>
                                    <img class="h-8 w-8 rounded-full" src="https://api.dicebear.com/6.x/avataaars/svg?seed=John" alt="User Avatar" />
                                </button>
                            </div>
                            <div
                                id="user-dropdown"
                                class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md border-gray-100 bg-white py-1 shadow-lg"
                                :class="{
                                    hidden: !isOpenUserDropdown,
                                }"
                                role="menu"
                                aria-orientation="vertical"
                                aria-labelledby="user-menu-button"
                                tabindex="-1"
                            >
                                <a
                                    href="#"
                                    class="block w-full cursor-pointer px-4 py-2 text-start text-sm text-gray-700 hover:bg-gray-100"
                                    role="menuitem"
                                    >Profile</a
                                >
                                <a
                                    href="#"
                                    class="block w-full cursor-pointer px-4 py-2 text-start text-sm text-gray-700 hover:bg-gray-100"
                                    role="menuitem"
                                    >Settings</a
                                >
                                <Link
                                    method="post"
                                    href="/logout"
                                    @click="handleLogout"
                                    as="button"
                                    class="block w-full cursor-pointer px-4 py-2 text-start text-sm text-gray-700 hover:bg-gray-100"
                                    role="menuitem"
                                    >Logout</Link
                                >
                            </div>
                        </div>
                        <BaseButton v-else href="/login" size="small" color="secondary">Login</BaseButton>
                    </div>
                </div>
            </Container>
        </nav>
    </header>
</template>
