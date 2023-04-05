<script setup>

import { Head, usePage } from '@inertiajs/vue3';

import Navbar from './Navigation/Navbar.vue';
import FlashMessage from './FlashMessage.vue';

const props = defineProps({
    title: {
      type :String,
      default: null
    }

});

</script>

<template>
<div class="bottom-0 fixed">*vue</div>

    <Head :title="title ? $page.props.appName + ' - ' + title : $page.props.appName" />

    <Navbar v-if="$page.props.auth.user"/>

    <main class="text-2xl grid place-items-center h-screen bg-gray-900">
      <slot />

    </main>
    <div v-if="!Object.values($page.props.flash).every(v => v===null)">
        <FlashMessage/>
    </div>

</template>