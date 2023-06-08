<script setup>
import { Head, useForm } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
import AppInputLabel from '@/Components/AppInputLabel.vue'
import AppTextInput from '@/Components/AppTextInput.vue'
import AppButtonPrimary from '@/Components/AppButtonPrimary.vue'
import AppInputError from '@/Components/AppInputError.vue'
import { toast } from 'vue3-toastify'

defineProps({
    companies: Array,
})

const employeeForm = useForm({
    first_name: null,
    last_name: null,
    company_id: null,
    email: null,
    phone: null,
})

const handleFormSubmit = async () => {
    employeeForm.post(route('employees.store'), {
        onSuccess: () => {
            employeeForm.reset()

            toast('New employee has been created')
        },
    })
}
</script>

<template>
    <AppLayout>
        <Head title="New employee" />

        <section class="px-4 lg:px-8">
            <div class="bg-white rounded shadow p-4 mx-auto max-w-xl lg:p-8">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-8">Company Details:</h2>
                <form
                    class="space-y-6"
                    @submit.prevent="handleFormSubmit"
                >
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <AppInputLabel for="employee-first-name">First name</AppInputLabel>
                            <AppTextInput
                                v-model="employeeForm.first_name"
                                id="employee-first-name"
                                name="name"
                            />
                            <AppInputError class="mt-2" :message="employeeForm.errors.first_name" />
                        </div>

                        <div>
                            <AppInputLabel for="employee-last-name">Last name</AppInputLabel>
                            <AppTextInput
                                v-model="employeeForm.last_name"
                                id="employee-last-name"
                                name="name"
                            />
                            <AppInputError class="mt-2" :message="employeeForm.errors.last_name" />
                        </div>
                    </div>

                    <div>
                        <AppInputLabel for="employee-company-id">Company</AppInputLabel>
                        <select
                            v-model="employeeForm.company_id"
                            id="countries"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        >
                            <option selected :value="null">Choose a company</option>

                            <option
                                v-for="company in companies"
                                :key="company.id"
                                :value="company.id"
                            >
                                {{ company.name }}
                            </option>
                        </select>
                        <AppInputError class="mt-2" :message="employeeForm.errors.company_id" />
                    </div>

                    <div>
                        <AppInputLabel for="employee-email">Email</AppInputLabel>
                        <AppTextInput
                            v-model="employeeForm.email"
                            id="employee-email"
                            name="email"
                        />
                        <AppInputError class="mt-2" :message="employeeForm.errors.email" />
                    </div>

                    <div>
                        <AppInputLabel for="employee-website">Phone</AppInputLabel>
                        <AppTextInput
                            v-model="employeeForm.phone"
                            id="employee-website"
                            name="website"
                        />
                        <AppInputError class="mt-2" :message="employeeForm.errors.phone" />
                    </div>

                    <div>
                        <AppButtonPrimary type="submit">
                            Save Changes
                        </AppButtonPrimary>
                    </div>
                </form>
            </div>




            <pre>{{ { employeeForm } }}</pre>





        </section>
    </AppLayout>
</template>
