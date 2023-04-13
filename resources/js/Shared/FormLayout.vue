<script setup>

import { inject } from 'vue';
import CrossIcon from '@/Shared/SVG/CrossIcon.vue';

    const props = defineProps({
        title: String,
        method : {
            type :String,
            default: null
        },
        submit : Function,
        routeName: String,
        box : {
            type : Boolean,
            default : true
        },
        shadow : {
            type : Boolean,
            default : false
        },
        class:String,
        closable: {
            type: Boolean,
            default: false
        },
        // class for form node
        class: {
            type: String,
            default : 'flex flex-col items-center'
        },

    });

    const form = inject('form');

</script>

<template>

    <div
        class=" relative p-4 rounded-xl w-full lg:w-1/2"
        :class="{
            'lg:bg-gray-800' : box,
            'shadow-2xl shadow-gray-800' : shadow
            }"
    >

        <!-- Close Button -->
        <div
            v-if="props.closable"
            class="absolute right-1 top-1"
            @click="$emit('closeForm')"
        >
            <CrossIcon width="30" height="30" class="fill-red-500"/>
        </div>

        <div v-if="title" class="text-3xl text-center mt-3 mb-5">
            {{ title }}
        </div>

        <div class="w-full mt-4">

            <form
                @submit.prevent="routeName ? form[method](routeName) : $emit('runSubmission')"
                :class="props.class"
            >

                <slot />
            </form>
        </div>

    </div>


</template>