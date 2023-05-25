<script setup>

    import { inject, computed } from 'vue';
    import FormError from '@/Shared/Form/FormError.vue';


    const props = defineProps({

        items: {
            type: Object,    // expects name value pairs
            required: true
        },
        label: {
            type: String,
            default: null
        },
        placeholder:{
            type: String,
            default:null
        },
        id : String,
        modelValue : String,
        error: String,
        fieldclass: {
            type: String,
            default : null
        },
    });

    const form = inject('form');


</script>

<template>
    <div class="flex items-center space-x-3 lg:text-xl">
        <p v-if="label" class="text-white mr-2">{{ label }}</p>

        <select
            :id="id"
            v-model="form[props.id]"
            class="text-gray-900 rounded p-1.5 flex-grow"
            :class="fieldclass"
        >
            <option :value="null" selected v-if="!form[props.id]">
                {{ placeholder }}
            </option>
            <option v-for="item in items" :key="item.id" :value="item.id">
                {{  item.name  }}
            </option>
        </select>

    </div>
    <div class="mb-2">
        <FormError v-if="form.errors[props.id]">
                {{ form.errors[props.id] }}
        </FormError>
    </div>

</template>
