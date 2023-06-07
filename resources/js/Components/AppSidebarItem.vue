<script setup>
import { Link } from '@inertiajs/vue3'

defineProps({
    routeName: String,
    label: String,
})
</script>

<template>
    <li>
        <Link
            :href="route(routeName)"
            :class="[route().current(routeName) ? 'bg-blue-500 text-white' : 'text-gray-900 hover:bg-gray-100']"
            class="flex items-center text-base font-medium rounded-lg px-4 py-3"
        >
            <slot name="icon" />

            <div class="ml-3">
                <slot>{{ label }}</slot>
            </div>
        </Link>
    </li>
</template>
