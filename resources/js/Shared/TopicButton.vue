<script setup>

import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';

    defineProps({
        href: {
            type: String,
            default: null
        },
        label:String,
        description:String,
        class:String,
        // click: function
    });

    let descriptionShow = ref(false);

</script>

<template>

    <div
        class="p-1 m-2 hover:z-50 text-white hover:scale-125 duration-500 lg:text-xl text-sm relative"
        @mouseover="descriptionShow = true"
        @mouseout="descriptionShow = false"
    >
        <Link
            :href="href"
            class="px-5 py-1 rounded-full uppercase font-semibold"
            :class="class"
            v-text="label"
        />
        <!-- Description or subtitle -->
        <div
            class="absolute text-sm bg-gray-200 text-gray-400 rounded p-2 w-auto top-1/2 left-1/2 bg-opacity-95"
            v-show="descriptionShow"
        >
            {{ description }}
        </div>
    </div>


</template>