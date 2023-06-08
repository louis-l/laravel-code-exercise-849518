<script setup>
import { Head, Link } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
import AppButtonPrimary from '@/Components/AppButtonPrimary.vue'

defineProps({
    companies: Object,
})
</script>

<template>
    <AppLayout>
        <Head title="Companies" />

        <section>
            <div class="px-4 lg:px-8">
                <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                    <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                        <div></div>

                        <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                            <Link :href="route('companies.create')">
                                <AppButtonPrimary class="inline-flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 -ml-1 mr-2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                    </svg>
                                    Add company
                                </AppButtonPrimary>
                            </Link>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-4 py-3">Logo</th>
                                    <th scope="col" class="px-4 py-3">Name</th>
                                    <th scope="col" class="px-4 py-3">Email</th>
                                    <th scope="col" class="px-4 py-3">Website</th>
                                    <th scope="col" class="px-4 py-3">Total employees</th>
                                    <th scope="col" class="px-4 py-3">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="company in companies.data"
                                    :key="company.id"
                                    class="border-b dark:border-gray-700"
                                >
                                    <td class="px-4 py-3">
                                        <img
                                            v-if="company.logo"
                                            :src="company.logo"
                                            class="max-w-[80px]"
                                        />
                                    </td>
                                    <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ company.name }}
                                    </th>
                                    <td class="px-4 py-3">
                                        {{ company.email }}
                                    </td>
                                    <td class="px-4 py-3">
                                        {{ company.website }}
                                    </td>
                                    <td class="px-4 py-3">
                                        {{ company.employees_count }}
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center justify-end space-x-2">
                                            <Link :href="route('companies.show', company)">
                                                <button
                                                    type="button"
                                                    class="px-2 py-1 text-xs font-medium text-center text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200"
                                                >View</button>
                                            </Link>

                                            <Link :href="route('companies.edit', company)">
                                                <button
                                                    type="button"
                                                    class="px-2 py-1 text-xs font-medium text-center text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200"
                                                >Edit</button>
                                            </Link>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4">
                        <div class="text-sm font-normal text-gray-500 dark:text-gray-400">
                            Showing
                            <span class="font-semibold text-gray-900 dark:text-white">{{ companies.from }}-{{ companies.to }}</span>
                            of
                            <span class="font-semibold text-gray-900 dark:text-white">{{ companies.total }}</span>
                        </div>

                        <div class="flex items-center space-x-3">
                            <!-- Previous Button -->
                            <Link
                                :href="companies.prev_page_url || '#'"
                                :class="!companies.prev_page_url ? 'cursor-not-allowed pointer-events-none opacity-50' : null"
                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                            >
                                <svg aria-hidden="true" class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd"></path></svg>
                                Previous
                            </Link>

                            <Link
                                :href="companies.next_page_url || '#'"
                                :class="!companies.next_page_url ? 'cursor-not-allowed pointer-events-none opacity-50' : null"
                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                            >
                                Next
                                <svg aria-hidden="true" class="w-4 h-4 ml-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            </Link>
                        </div>
                    </nav>
                </div>
            </div>
        </section>
    </AppLayout>
</template>
