<template>
    <Transition name="fade">
        <div v-if="show" class="rounded-md bg-green-50 p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <CheckCircleIcon class="h-5 w-5 text-green-400" aria-hidden="true"/>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-green-800">{{ modelValue }}</p>
                </div>
                <div class="ml-auto pl-3">
                    <div class="-mx-1.5 -my-1.5">
                        <button @click="onCloseAlert"
                                type="button"
                                class="inline-flex rounded-md bg-green-50 p-1.5 text-green-500 hover:bg-green-100 focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2 focus:ring-offset-green-50">
                            <span class="sr-only">Dismiss</span>
                            <XMarkIcon class="h-5 w-5" aria-hidden="true"/>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </Transition>
</template>

<script setup>
import {CheckCircleIcon, XMarkIcon} from '@heroicons/vue/24/solid'
import {ref, watch} from "vue";

const props = defineProps({
    modelValue: String
})

const show = ref(false);
const emit = defineEmits(['update:modelValue'])

watch(() => props.modelValue, (message) => {
    if (message) {
        show.value = true
        setTimeout(() => onCloseAlert(), 3000)
        return ''
    }
    show.value = false;
})

const onCloseAlert = function () {
    emit('update:modelValue', null)
}
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.5s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}

</style>
