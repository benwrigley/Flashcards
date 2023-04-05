<script setup>

import { inject } from 'vue';

    defineProps({
        title: String,
        method : String,
        routeName: String,

    });

    const form = inject('form');

</script>

<template>

    <div class="lg:bg-gray-800 p-4 rounded-xl w-full lg:w-1/2">

        <div v-if="title" class="text-2xl lg:text-3xl text-center mt-3 lg:mb-3">
            {{ title }}
        </div>

        <div class="w-full mt-4">

            <form @submit.prevent="form[method](routeName)" :class="$attrs.class || 'flex flex-col items-center'">

                <slot />
            </form>
        </div>

    </div>


</template>