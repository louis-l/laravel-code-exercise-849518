<script setup>
import { ref, computed } from 'vue'
import { Link, usePage } from '@inertiajs/vue3'
import AppSidebar from '@/Components/AppSidebar.vue'

const page = usePage()

const showUserDropdownMenu = ref(false)
const authUser = computed(() => page.props.auth.user)
</script>

<template>
    <div class="antialiased bg-gray-50 dark:bg-gray-900">
        <nav class="bg-white border-b border-gray-200 px-4 py-2.5 dark:bg-gray-800 dark:border-gray-700 fixed left-0 right-0 top-0 z-50">
            <div class="flex flex-wrap justify-between items-center">
                <Link :href="route('home')" class="flex items-center justify-between mr-4">
                    <img
                        src="https://placehold.co/600x120?text=Logo"
                        class="h-8 rounded"
                        alt="Logo"
                    />
                </Link>

                <div class="relative flex items-center lg:order-2">
                    <button
                        type="button"
                        class="flex mx-3 text-sm bg-gray-800 rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                        @click="showUserDropdownMenu = !showUserDropdownMenu"
                    >
                        <span class="sr-only">Open user menu</span>
                        <img
                            class="w-8 h-8 rounded-full"
                            src="https://picsum.photos/200/200"
                            alt="user photo"
                        />
                    </button>

                    <!-- Dropdown menu -->
                    <div
                        v-show="showUserDropdownMenu"
                        class="absolute top-6 right-0 z-50 my-4 w-56 text-base list-none bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600 rounded-xl"
                    >
                        <div class="py-3 px-4">
                            <span class="block text-sm font-semibold text-gray-900 dark:text-white">{{ authUser.name }}</span>
                            <span class="block text-sm text-gray-900 truncate dark:text-white">{{ authUser.email }}</span>
                        </div>
                        <ul class="py-1 text-gray-700 dark:text-gray-300">
                            <li>
                                <a
                                    href="#"
                                    class="block py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-400 dark:hover:text-white"
                                >My profile</a>
                            </li>
                            <li>
                                <a
                                    href="#"
                                    class="block py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-400 dark:hover:text-white"
                                >Account settings</a>
                            </li>
                        </ul>
                        <ul class="py-1 text-gray-700 dark:text-gray-300">
                            <li>
                                <a
                                    href="#"
                                    class="block py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                >Sign out</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Sidebar -->
        <aside
            class="fixed top-0 left-0 z-40 w-64 h-screen pt-14 transition-transform -translate-x-full bg-white border-r border-gray-200 md:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
            aria-label="Sidenav"
            id="drawer-navigation"
        >
            <div class="overflow-y-auto py-5 px-3 h-full bg-white dark:bg-gray-800">
                <AppSidebar />
            </div>
        </aside>

        <main class="min-h-screen bg-gray-50 dark:bg-gray-900 p-4 md:ml-64 h-auto pt-20">
            <slot />
        </main>
    </div>
</template>
