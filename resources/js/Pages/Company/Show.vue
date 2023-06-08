<script setup>
import { Head, Link, router } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
import AppInputLabel from '@/Components/AppInputLabel.vue'
import { toast } from 'vue3-toastify'

const props = defineProps({
    company: Object,
})

const handleDeleteButtonClicked = () => {
    if (!confirm('Are you sure you want to delete this company?')) {
        return
    }

    router.delete(route('companies.destroy', props.company))

    // Wrap in a timeout to run this function after navigation.
    // Otherwise the toast will show and instantly disappear.
    setTimeout(() => {
        toast('Company has been deleted')
    }, 500)
}
</script>

<template>
    <AppLayout>
        <Head :title="company.name" />

        <section class="px-4 lg:px-8">
            <div class="bg-white rounded shadow p-4 mx-auto max-w-xl lg:p-8">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-8">Company Details:</h2>
                <div class="space-y-6">
                    <div>
                        <AppInputLabel for="company-name">Name</AppInputLabel>
                        <div>
                            {{ company.name }}
                        </div>
                    </div>

                    <div>
                        <AppInputLabel for="company-email">Email</AppInputLabel>
                        <div>
                            {{ company.email }}
                        </div>
                    </div>

                    <div>
                        <AppInputLabel for="company-website">Website</AppInputLabel>
                        <div>
                            {{ company.website }}
                        </div>
                    </div>

                    <div>
                        <AppInputLabel>Logo</AppInputLabel>
                        <div>
                            <img
                                v-if="company.logo"
                                :src="company.logo"
                                class="border rounded"
                            />

                            <div
                                v-else
                                class="text-xs text-slate-400"
                            >
                                No data
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <Link :href="route('companies.edit', company)">
                            <button
                                type="button"
                                class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                            >Edit company</button>
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
