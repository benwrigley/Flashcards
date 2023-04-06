<script setup>

    import {Link } from '@inertiajs/vue3'

    defineProps({
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

</script>

<template>


<Link
    :href="link"
    as="button"
    class="rounded py-2 px-4 hover:animate-pulse hover:bg-blue-500 hover:text-white hover:scale-110 duration-500 text-base lg:text-2xl"
    :class="class"
>
    {{ label }}

</Link>

</template>