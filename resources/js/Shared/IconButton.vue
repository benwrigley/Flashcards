<script setup>

    import { ref } from 'vue';

    defineProps({
        tooltip : {
            type: String,
            default: null
        },
        disable : {
            type: Boolean,
            default: false
        }
    });

    let showtip = ref(false);

</script>

<template>
    <div class="relative flex justify-center">
        <div
            :class="{
                'bg-gray-700 p-1 rounded hover:scale-125 duration-200 hover:bg-blue-500' : !disable,
                'bg-gray-800 p-1 rounded' : disable
            }"
            @mouseover="showtip = true"
            @mouseout="showtip = false"
        >
            <slot /> <!-- svg -->
        </div>
        <div
            v-if="showtip && tooltip !== null && !disable"
            class="absolute -top-12 -left-10 bg-blue-500 rounded p-2 text-sm w-max duration-200"
            @mouseout="showtip = false"
        >
                {{ tooltip }}
        </div>
    </div>

</template>