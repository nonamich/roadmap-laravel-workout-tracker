<script setup lang="ts">
import { Link } from "@inertiajs/vue3";
import Container from "./AppContainer.vue";
</script>

<template>
  <header>
    <nav class="bg-blue-600 text-white shadow-md mb-3">
      <Container>
        <div class="flex justify-between h-16">
          <div class="flex items-center">
            <div class="flex-shrink-0 flex items-center">
              <span class="text-xl font-bold">FitTrack</span>
            </div>
            <div class="hidden md:ml-6 md:flex md:space-x-8">
              <Link
                href="#features"
                class="inline-flex items-center px-1 pt-1 text-sm font-medium hover:text-blue-200"
              >
                Features
              </Link>
              <a
                href="#workouts"
                class="inline-flex items-center px-1 pt-1 text-sm font-medium hover:text-blue-200"
              >
                My Workouts
              </a>
              <a
                href="#schedule"
                class="inline-flex items-center px-1 pt-1 text-sm font-medium hover:text-blue-200"
              >
                Schedule
              </a>
              <a
                href="#reports"
                class="inline-flex items-center px-1 pt-1 text-sm font-medium hover:text-blue-200"
              >
                Reports
              </a>
            </div>
          </div>
          <div class="flex items-center">
            <div class="relative ml-3">
              <div>
                <button
                  id="user-menu-button"
                  type="button"
                  class="flex rounded-full bg-blue-500 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-blue-600"
                  aria-expanded="false"
                  aria-haspopup="true"
                >
                  <span class="sr-only">Open user menu</span>
                  <img
                    class="h-8 w-8 rounded-full"
                    src="https://api.dicebear.com/6.x/avataaars/svg?seed=John"
                    alt="User Avatar"
                  >
                </button>
              </div>
              <!-- Dropdown menu, hidden by default -->
              <div
                id="user-dropdown"
                class="hidden absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                role="menu"
                aria-orientation="vertical"
                aria-labelledby="user-menu-button"
                tabindex="-1"
              >
                <a
                  href="#"
                  class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                  role="menuitem"
                >Profile</a>
                <a
                  href="#"
                  class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                  role="menuitem"
                >Settings</a>
                <a
                  href="#"
                  class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                  role="menuitem"
                >Logout</a>
              </div>
            </div>
            <!-- Mobile menu button -->
            <div class="flex items-center md:hidden ml-4">
              <button
                id="mobile-menu-button"
                type="button"
                class="inline-flex items-center justify-center p-2 rounded-md text-white hover:text-blue-200 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                aria-controls="mobile-menu"
                aria-expanded="false"
              >
                <span class="sr-only">Open main menu</span>
                <i class="fas fa-bars" />
              </button>
            </div>
          </div>
        </div>
      </Container>

      <!-- Mobile menu, hidden by default -->
      <div
        id="mobile-menu"
        class="hidden md:hidden bg-blue-700"
      >
        <div class="space-y-1 px-2 pb-3 pt-2">
          <a
            href="#features"
            class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-blue-800"
          >Features</a>
          <a
            href="#workouts"
            class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-blue-800"
          >My
            Workouts</a>
          <a
            href="#schedule"
            class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-blue-800"
          >Schedule</a>
          <a
            href="#reports"
            class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-blue-800"
          >Reports</a>
        </div>
      </div>
    </nav>
  </header>
  <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <Container>
      <slot />
    </Container>
  </main>
  <footer class="bg-gray-800 text-white py-12">
    <Container>
      <div class="flex flex-col md:flex-row justify-between items-center">
        <div class="flex items-center">
          <p class="text-gray-300">
            FitTrack
            <span class="text-gray-500">| Tracking your fitness journey since
              {{ new Date().getFullYear() }}</span>
          </p>
        </div>
        <p class="text-gray-500 mt-4 md:mt-0">
          © {{ new Date().getFullYear() }} FitTrack. All rights
          reserved.
        </p>
      </div>
    </Container>
  </footer>
</template>
