<script setup>

    import { inject, computed } from 'vue';
    import FormError from '@/Shared/Form/FormError.vue';


    const props = defineProps({

        items: {
            type: Array,
            required: true
        },
        label: {
            type: String,
            default: null
        },
        itemClasses: {
            type:String,
            default: null
        },
        unselected: {
            type:String,
            default: null
        },
        selected: {
            type:String,
            default: 'border-2'
        },
        id : String,
        modelValue : String,
        error: String,
    });

    const form = inject('form');

    console.log(props.label);

</script>

<template>
    <div class="flex mb-5 items-center w-max space-x-3 text-xl">
        <p class="mr-2">{{ label }}</p>
            <div
                v-for="item in items"
                class="flex justify-center"
                :class="{
                    [selected]: form[props.id] === item,
                    [unselected]: form[props.id] !== item,
                    'rounded ml-2 p-2 hover:bg-gray-200 w-8 h-8': !itemClasses,
                    [itemClasses] : itemClasses
                    }"
                @click="form[props.id] = item"
            >
            {{  item }}
            </div>
    </div>
    <FormError v-if="form.errors[props.id]">
            {{ form.errors[props.id] }}
    </FormError>

</template>
