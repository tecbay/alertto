<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, router, useForm} from '@inertiajs/vue3';
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {ref} from "vue";
import TargetingRule from "@/Pages/TargetingRule/Parts/TargetingRule.vue";
import {ArrowLeftIcon} from '@heroicons/vue/20/solid'
import SecondaryButton from "@/Components/SecondaryButton.vue";

const newRule = function () {
    alertForm.rules.push({
        action: 'show',
        condition: 'contains',
        value: ''
    })
}

const onDelete = function (index) {
    alertForm.rules.splice(index, 1)
}

const alertForm = useForm({
    message: '',
    rules: [{
        action: 'show',
        condition: 'contains',
        value: ''
    }]
});

</script>

<template>
    <Head title="Dashboard"/>

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center gap-5">
                <button type="button"
                        @click="()=>{router.get(route('alerts.index'))}"
                        class="rounded-full bg-gray-600 p-1 text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600">
                    <ArrowLeftIcon class="w-5 h-5 "></ArrowLeftIcon>
                </button>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create new alert</h2>
            </div>
        </template>

        <div class="max-w-3xl mx-auto py-12 sm:px-6 lg:px-8 flex flex-col gap-5">
            <div class="self-end">
                <SecondaryButton @click="()=>{alertForm.post(route('alerts.store'))}">Save</SecondaryButton>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5">
                <InputLabel for="alert-message" value="Alert Message"/>
                <TextInput
                    id="alert-message"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    placeholder="e.g. hello world!"
                    v-model="alertForm.message"
                />
                <InputError class="mt-2"/>
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg p-5 ">

                <TargetingRule
                    v-for="(targetingRule,i) in alertForm.rules"
                    @delete:targetingRule="onDelete"
                    :key="i"
                    v-model="alertForm.rules[i]"
                    :index="i">
                </TargetingRule>

                <div class="mt-5">
                    <PrimaryButton @click="newRule">New rule</PrimaryButton>
                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>
