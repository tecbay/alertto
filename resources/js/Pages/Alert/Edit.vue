<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, router, useForm, usePage} from '@inertiajs/vue3';
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {ref} from "vue";
import TargetingRule from "@/Pages/Alert/Parts/TargetingRule.vue";
import {ArrowLeftIcon} from '@heroicons/vue/20/solid'
import SecondaryButton from "@/Components/SecondaryButton.vue";
import VueCodeHighlight from 'vue-code-highlight';
import Alert from "@/Components/Alert.vue";

const props = defineProps({
    alert: {required: true, type: Object}
})

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
    message: props.alert.message,
    rules: props.alert.targeting_rules
});

</script>

<template>
    <Head title="Modify Alert"/>

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center gap-5">
                <button type="button"
                        @click="()=>{router.get(route('alerts.index'))}"
                        class="rounded-full bg-gray-600 p-1 text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600">
                    <ArrowLeftIcon class="w-5 h-5 "></ArrowLeftIcon>
                </button>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Modify Alert</h2>
            </div>
        </template>

        <div class="max-w-3xl mx-auto py-12 sm:px-6 lg:px-8 flex flex-col gap-5">

            <Alert v-model="usePage().props.flash.message"></Alert>

            <div class="self-end">
                <SecondaryButton @click="()=>{alertForm.patch(route('alerts.update',{alert:props.alert.ulid}))}">Update</SecondaryButton>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5">
                <p class="text-sm py-2 text-gray-500 font-semibold">Include the JavaScript on your page once, ideally inside Head tag.</p>
                <code>
                    <pre class="p-5 bg-gray-800 text-white rounded-lg overflow-auto">
&lt;script async&gt;
    var currentPath = window.location.pathname;
    var scriptTag = document.createElement('script');
    scriptTag.src = '{{usePage().props.ziggy.url}}/alert.js?id={{props.alert.ulid}}&amp;path='+encodeURIComponent(currentPath);
    document.head.appendChild(scriptTag);
&lt;/script&gt;</pre>
                    </code>
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
                <InputError class="mt-2" :message="alertForm.errors.message"/>
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg p-5 ">

                <TargetingRule
                    v-for="(targetingRule,i) in alertForm.rules"
                    @delete:targetingRule="onDelete"
                    :key="i"
                    v-model="alertForm.rules[i]"
                    :error-message="alertForm.errors[`rules.${i}.value`]"
                    :index="i">
                </TargetingRule>

                <div class="mt-5">
                    <PrimaryButton @click="newRule">New rule</PrimaryButton>
                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>
