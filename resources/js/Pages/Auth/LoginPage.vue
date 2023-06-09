<script setup>
import AppCheckbox from '@/Components/AppCheckbox.vue'
import AuthLayout from '@/Layouts/AuthLayout.vue'
import AppInputError from '@/Components/AppInputError.vue'
import AppInputLabel from '@/Components/AppInputLabel.vue'
import AppButtonPrimary from '@/Components/AppButtonPrimary.vue'
import AppTextInput from '@/Components/AppTextInput.vue'
import { Head, Link, useForm } from '@inertiajs/vue3'

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
})

const form = useForm({
    email: '',
    password: '',
    remember: false,
})

const handleLogin = () => {
    form.post(route('login'), {
        onSuccess: () => form.reset('password'),
    })
}
</script>

<template>
    <AuthLayout>
        <Head title="Log in" />

        <section class="bg-gray-50 dark:bg-gray-900">
            <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
                <div class="flex items-center mb-4">
                    <img class="w-48 h-10 rounded" src="https://placehold.co/600x120?text=Logo" alt="logo">
                </div>
                <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                        <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                            Sign in to your account
                        </h1>

                        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
                            {{ status }}
                        </div>

                        <form @submit.prevent="handleLogin" class="space-y-4 md:space-y-6">
                            <div>
                                <AppInputLabel for="email" value="Email" />

                                <AppTextInput
                                    v-model="form.email"
                                    id="email"
                                    type="email"
                                    required
                                    autofocus
                                    placeholder="email@mail.com"
                                    autocomplete="email"
                                    class="mt-1 block w-full"
                                />

                                <AppInputError class="mt-2" :message="form.errors.email" />
                            </div>
                            <div>
                                <AppInputLabel for="email" value="Password" />

                                <AppTextInput
                                    v-model="form.password"
                                    id="password"
                                    type="password"
                                    placeholder="••••••••"
                                    required
                                    autocomplete="current-password"
                                    @keyup.enter="handleLogin"
                                />

                                <AppInputError class="mt-2" :message="form.errors.password" />
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="flex items-start">
                                    <div class="flex items-center h-5">
                                        <AppCheckbox id="remember" name="remember" v-model:checked="form.remember" />
                                    </div>
                                    <div class="ml-3 text-sm">
                                        <label for="remember" class="text-gray-500 dark:text-gray-300">Remember me</label>
                                    </div>
                                </div>

                                <Link
                                    v-if="canResetPassword"
                                    :href="route('password.request')"
                                    class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500"
                                >Forgot password?</Link>
                            </div>

                            <AppButtonPrimary
                                :disabled="form.processing"
                                :class="{ 'opacity-25': form.processing }"
                                class="w-full"
                                @click="handleLogin"
                            >
                                Log in
                            </AppButtonPrimary>

                            <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                                Don’t have an account yet? <a href="#" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Sign up</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </AuthLayout>
</template>
