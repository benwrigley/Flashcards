<script setup>

    import { computed } from '@vue/reactivity';
    import { inject} from 'vue';

    const props = defineProps({
        type: {
            type : String,
            default : 'submit'
        },
        label: String,
        class: {
            type: String,
            default : 'bg-gray-700 text-white'
        },
        link: {
            type:String,
            default : null
        }
    });

    const form = inject('form');

    const defaultClasses = 'rounded py-2 px-4 hover:animate-pulse hover:bg-blue-500 hover:text-white hover:scale-110 duration-500 text-base lg:text-2xl';

    const additionalClasses = computed(() => {

        return form.processing ?
            'cursor-progress ' + props.class + ' ' + defaultClasses :
            props.class + ' ' + defaultClasses;
    });

</script>

<template>

    <button
            :disabled="form.processing"
            :type="type"
            :class="additionalClasses"
    >
            {{ label }}
    </button>

</template>