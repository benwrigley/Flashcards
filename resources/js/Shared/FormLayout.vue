<script setup>

import { inject } from 'vue';

    const props = defineProps({
        title: String,
        method : String,
        routeName: String,
        box : {
            type : Boolean,
            default : true
        }

    });

    const form = inject('form');

</script>

<template>

    <div
        class="p-4 rounded-xl w-full lg:w-1/2"
        :class="{'lg:bg-gray-800' : box}">

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