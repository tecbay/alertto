<script setup>

import CirculerButton from "@/Components/CirculerButton.vue";
import {computed} from "vue";
import InputError from "@/Components/InputError.vue";

const props = defineProps({
    modelValue: {
        type: Object,
        required: true
    },
    index: {
        type: Number,
        required: true
    },
    errorMessage: {
        type: String
    }
});

const action = computed({
    get() {
        return props.modelValue.action
    },
    set(value) {
        props.modelValue.action = value
    }
})

const condition = computed({
    get() {
        return props.modelValue.condition
    },
    set(value) {
        props.modelValue.condition = value
    }
})

const value = computed({
    get() {
        return props.modelValue.value
    },
    set(value) {
        props.modelValue.value = value
    }
})
const emit = defineEmits(['delete:targetingRule'])
</script>

<template>
    <div class="flex gap-3">
        <div>
            <div>
                <select v-model="action" id="actions"
                        class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    <option value="show">Show on</option>
                    <option value="hide">Don't show</option>
                </select>
            </div>
        </div>
        <div class="flex">
            <div>
                <select v-model="condition"
                        class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300
                                    focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6"
                >
                    <option value="contains">pages that contains</option>
                    <option value="equals">a specific page</option>
                    <option value="start-with">page starting with</option>
                    <option value="end-with">page ending with</option>
                </select>
            </div>
        </div>
        <div class="flex-1">
            <div>
                <div class="mt-2 flex rounded-md shadow-sm">
                                <span
                                    class="inline-flex items-center rounded-l-md border border-r-0 border-gray-300 px-3 text-gray-500 sm:text-sm">
                                    https://domain.com/</span>

                    <input type="text"
                           v-model="value"
                           :class="['block w-full min-w-0 flex-1 rounded-none rounded-r-md border-0 py-1.5 text-gray-900 ring-1 ring-inset',
                           'focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6',
                           errorMessage?'ring-red-300 placeholder:text-red-400':'ring-gray-300 placeholder:text-gray-400'
                             ]"
                           placeholder="abc"/>
                </div>
            </div>
        </div>
        <div class="self-center mt-2">
            <CirculerButton @click="$emit('delete:targetingRule',index)" :class="[index==0?'invisible':'']"></CirculerButton>
        </div>
    </div>
</template>


<style scoped>

</style>
