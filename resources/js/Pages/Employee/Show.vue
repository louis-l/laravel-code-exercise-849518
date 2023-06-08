<script setup>
import { Head, Link, router } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
import AppInputLabel from '@/Components/AppInputLabel.vue'
import { toast } from 'vue3-toastify'

const props = defineProps({
    employee: Object,
})

const handleDeleteButtonClicked = () => {
    if (!confirm('Are you sure you want to delete this employee?')) {
        return
    }

    router.delete(route('employees.destroy', props.employee))

    // Wrap in a timeout to run this function after navigation.
    // Otherwise the toast will show and instantly disappear.
    setTimeout(() => {
        toast('Employee has been deleted')
    }, 500)
}
</script>

<template>
    <AppLayout>
        <Head :title="`${employee.first_name} ${employee.last_name}`" />

        <section class="px-4 lg:px-8">
            <div class="bg-white rounded shadow p-4 mx-auto max-w-xl lg:p-8">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-8">Employee Details:</h2>
                <div class="space-y-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <AppInputLabel for="employee-first-name">First name</AppInputLabel>

                            <div>
                                {{ employee.first_name }}
                            </div>
                        </div>

                        <div>
                            <AppInputLabel for="employee-last-name">Last name</AppInputLabel>

                            <div>
                                {{ employee.last_name }}
                            </div>
                        </div>
                    </div>

                    <div>
                        <AppInputLabel for="employee-company-id">Company</AppInputLabel>

                        <div v-if="employee.company">
                            {{ employee.company.name }}
                        </div>
                        <div v-else>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-slate-300">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15" />
                            </svg>
                        </div>
                    </div>

                    <div>
                        <AppInputLabel for="employee-email">Email</AppInputLabel>

                        <div v-if="employee.email">
                            {{ employee.email }}
                        </div>
                        <div v-else>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-slate-300">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15" />
                            </svg>
                        </div>
                    </div>

                    <div>
                        <AppInputLabel for="employee-website">Phone</AppInputLabel>

                        <div v-if="employee.phone">
                            {{ employee.phone }}
                        </div>
                        <div v-else>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-slate-300">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15" />
                            </svg>
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <Link :href="route('employees.edit', employee)">
                            <button
                                type="button"
                                class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                            >Edit employee</button>
                        </Link>

                        <button
                            type="button"
                            class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"
                            @click="handleDeleteButtonClicked"
                        >Delete</button>
                    </div>
                </div>
            </div>
        </section>
    </AppLayout>
</template>
