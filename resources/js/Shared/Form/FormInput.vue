<script setup>

import { inject, ref, watch } from 'vue';

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
        default: ''
    },
    fieldclass: {
        type: String,
        default : 'w-full'
    },
    label : {
        type: String,
        default: null
    },

    dark: {
        type:Boolean,
        default:false
    },
    rows: {
        type:String,
        default:"4"
    }

});

const form = inject('form');
const getValue = ref(form[props.id]);

const updateValue = (newValue) => {
  form[props.id] = newValue;
};

watch(() => form[props.id], (newValue) => {
  getValue.value = newValue;
});

</script>

<template>

    <div class="flex text-black space-x-3 items-center" :class="class">

        <label :for="id" v-if="label" class="text-white mr-2">{{ label }}</label>

        <component

            :is="type === 'text' || type === 'password' ? 'input' : 'textarea'"
            :id="id"
            :type="type"
            :placeholder="placeholder"
            :value="getValue"
            @input="updateValue($event.target.value)"
            :rows="rows"
            :class="{
                'border border-gray-400 p-2 rounded text-base lg:text-xl' : true,
                [fieldclass] : fieldclass,
                'bg-gray-800 text-white' : dark,
                'text-gray-700' : !dark
            }"
        ></component>
    </div>
    <div>
        <FormError v-if="form.errors[props.id]">
            {{ form.errors[props.id] }}
        </FormError>
    </div>

</template>