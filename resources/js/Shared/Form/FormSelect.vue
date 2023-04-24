<script setup>

    import { inject, computed } from 'vue';
    import FormError from '@/Shared/Form/FormError.vue';


    const props = defineProps({

        items: {
            type: Array,    // expects name value pairs
            required: true
        },
        label: {
            type: String,
            default: null
        },
        id : String,
        modelValue : String,
        error: String,
    });

    const form = inject('form');


</script>

<template>
    <div class="flex mb-5 items-center w-max space-x-3 text-xl">
        <p class="mr-2">{{ label }}</p>


        <select
            :id="id"
            v-model="form[props.id]"
            class="text-gray-900 rounded p-1.5"
        >
            <option v-for="(id, name) in items" :key="id" :value="id" :selected="id === topic.topic_id">
                {{ name }}
            </option>
        </select>

    </div>
    <FormError v-if="form.errors[props.id]">
            {{ form.errors[props.id] }}
    </FormError>

</template>
