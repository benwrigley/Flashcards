<script setup>

    import { inject, computed } from 'vue';
    import FormError from '@/Shared/Form/FormError.vue';


    const props = defineProps({
        id : String,
        modelValue : String,
        error: String,
    });


    const colors = [
        'bg-blue-300',
        'bg-purple-400',
        'bg-red-400',
        'bg-green-400',
        'bg-yellow-400',
        'bg-gray-600',
        'bg-pink-400'
    ];

    const form = inject('form');

    function calculateClasses(c) {

        return c + (form[props.id] === c ? ' border-2' : '')

    }


</script>

<template>
    <div class="flex justify mb-2 items-center">
        <div v-for="color in colors">
            <div
                class="rounded ml-2 p-2 hover:bg-gray-200 w-8 h-8"
                :class="calculateClasses(color)"
                @click="form[props.id] = color"
            >

            </div>
        </div>
    </div>
    <FormError v-if="form.errors[props.id]">
            {{ form.errors[props.id] }}
    </FormError>

</template>
