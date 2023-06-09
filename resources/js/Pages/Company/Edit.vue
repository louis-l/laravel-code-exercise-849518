<script setup>
import { ref } from 'vue'
import { toast } from 'vue3-toastify'
import { Head, useForm } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
import AppInputLabel from '@/Components/AppInputLabel.vue'
import AppTextInput from '@/Components/AppTextInput.vue'
import AppButtonPrimary from '@/Components/AppButtonPrimary.vue'
import AppInputError from '@/Components/AppInputError.vue'

const props = defineProps({
    company: Object,
})

const companyForm = useForm({
    ...props.company,
    logo: null,
})
const currentLogo = ref(props.company.logo)

const handleFormSubmit = async () => {
    companyForm
        .transform((data) => ({
            ...data,
            logo_previous: currentLogo.value,
            _method: 'put',
        }))
        .post(route('companies.update', props.company), {
            onSuccess: () => {
                companyForm.reset()

                toast('Company details have been updated')
            },
        })
}
</script>

<template>
    <AppLayout>
        <Head :title="company.name" />

        <section class="px-4 lg:px-8">
            <div class="bg-white rounded shadow p-4 mx-auto max-w-xl lg:p-8">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-8">Company Details:</h2>
                <form
                    class="space-y-6"
                    @submit.prevent="handleFormSubmit"
                >
                    <div>
                        <AppInputLabel for="company-name">Name</AppInputLabel>
                        <AppTextInput
                            v-model="companyForm.name"
                            id="company-name"
                            name="name"
                        />
                        <AppInputError class="mt-2" :message="companyForm.errors.name" />
                    </div>

                    <div>
                        <AppInputLabel for="company-email">Email</AppInputLabel>
                        <AppTextInput
                            v-model="companyForm.email"
                            id="company-email"
                            name="email"
                        />
                        <AppInputError class="mt-2" :message="companyForm.errors.email" />
                    </div>

                    <div>
                        <AppInputLabel for="company-website">Website</AppInputLabel>
                        <AppTextInput
                            v-model="companyForm.website"
                            id="company-website"
                            name="website"
                        />
                        <AppInputError class="mt-2" :message="companyForm.errors.website" />
                    </div>

                    <div>
                        <AppInputLabel>Logo</AppInputLabel>

                        <div v-if="currentLogo">
                            <img
                                :src="currentLogo"
                                class="border rounded"
                            />

                            <button
                                title="Click to upload new logo"
                                type="button"
                                class="text-xs text-slate-600 underline hover:text-blue-600"
                                @click="currentLogo = null"
                            >
                                Change logo
                            </button>
                        </div>

                        <div v-else>
                            <span class="sr-only">Choose logo</span>
                            <input
                                type="file"
                                name="logo"
                                class="block w-full text-sm text-slate-500 file:cursor-pointer file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gray-600 file:text-gray-50 hover:file:bg-gray-500"
                                @input="companyForm.logo = $event.target.files[0]"
                            />
                            <div class="text-xs text-slate-400 mt-2">
                                Minimum 100x100px
                            </div>
                        </div>
                        <AppInputError class="mt-2" :message="companyForm.errors.logo" />
                    </div>

                    <div>
                        <AppButtonPrimary type="submit">
                            Save Changes
                        </AppButtonPrimary>
                    </div>
                </form>
            </div>
        </section>

        <pre>{{ {companyForm} }}</pre>
    </AppLayout>
</template>
