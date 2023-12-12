<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, router} from '@inertiajs/vue3';
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {ChevronRightIcon} from '@heroicons/vue/24/solid'

const props = defineProps({
    alerts: {
        required: true,
        type: Array
    }
})
</script>

<template>
    <Head title="Alertto"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Alerts</h2>
        </template>

        <div class="max-w-3xl mx-auto py-12 sm:px-6 lg:px-8 flex flex-col gap-5">
            <div class="flex justify-end">
                <PrimaryButton @click="()=>{router.get(route('alerts.create'))}">Create New Alert</PrimaryButton>
            </div>

            <div v-if="alerts.length === 0" class="bg-white grid justify-items-center items-center h-20 rounded-lg">
                <p class="text-gray-500 text-md">You haven't created any alert messages yet.</p>
            </div>

            <ul v-else role="list" class="divide-y divide-gray-100 overflow-hidden bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl">
                <li v-for="alert in alerts" :key="alert.ulid" class="relative flex justify-between gap-x-6 px-4 py-5 hover:bg-gray-50 sm:px-6">
                    <div class="flex min-w-0 gap-x-4">
                        <div class="min-w-0 flex-auto">
                            <p class="text-sm font-semibold leading-6 text-gray-900">
                                <a :href="route('alerts.edit',{alert:alert.ulid})">
                                    <span class="absolute inset-x-0 -top-px bottom-0"/>
                                    {{ alert.message }}
                                </a>
                            </p>
                            <p class="mt-1 flex text-xs leading-5 text-gray-500">
                                <a class="relative truncate hover:underline"></a>
                            </p>
                        </div>
                    </div>
                    <div class="flex shrink-0 items-center gap-x-4">
                        <div class="hidden sm:flex sm:flex-col sm:items-end">
                            <p class="text-sm text-indigo-500 leading-6 text-gray-900">Modify</p>
                        </div>
                        <ChevronRightIcon class="h-5 w-5 flex-none text-gray-400" aria-hidden="true"/>
                    </div>
                </li>
            </ul>

        </div>
    </AuthenticatedLayout>
</template>
