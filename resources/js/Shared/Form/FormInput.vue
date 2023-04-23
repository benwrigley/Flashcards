<script setup>

import { inject } from 'vue';

import FormError from '@/Shared/Form/FormError.vue';

const props = defineProps({
    type : {
        type : String,
        default : 'text'
    },
    id : String,
    placeholder: String,
    modelValue : String,
    error: String,
    class : {
        type: String,
        default: 'w-11/12 lg:w-4/6'
    },
    fieldclass: String

});

const form = inject('form');


</script>

<template>

    <div class="mb-4 text-black" :class="class">

        <input
            v-if="['text','password'].indexOf(props.type) > -1"
            :id="id"
            :type="type"
            :placeholder="placeholder"
            v-model="form[props.id]"
            class="border border-gray-400 p-2 text-gray-700 rounded text-base lg:text-xl w-full"
            :class="fieldclass"/>

        <textarea
            v-else-if="props.type === 'textarea'"
            :id="id"
            :type="type"
            :placeholder="placeholder"
            v-model="form[props.id]"
            class="border border-gray-400 p-2 text-gray-700 rounded text-base lg:text-xl w-full"
            :class="fieldclass"></textarea>


        <FormError v-if="form.errors[props.id]">
            {{ form.errors[props.id] }}
        </FormError>
    </div>

</template>