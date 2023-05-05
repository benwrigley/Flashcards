<script setup>

import { Head, usePage } from '@inertiajs/vue3';

import Navbar from './Navigation/Navbar.vue';
import FlashMessage from './FlashMessage.vue';

const props = defineProps({
    title: {
      type :String,
      default: null
    },
    type: {
      type: String,
      default: 'centered'
    },
    fade : {
      type:Boolean,
      default: false,
    },
    navtitle: {
      type:String,
      default: null
    }


});

</script>

<template>
<div class="bottom-0 fixed">*vue {{ !Object.values($page.props.flash).every(v => v===null) }}</div>



    <Head :title="title ? $page.props.appName + ' - ' + title : $page.props.appName" />

    <Navbar v-if="$page.props.auth.user" class="z-10" :title="navtitle"/>

    <main
      class="text-2xl bg-gray-900 z-0"
      :class="{
        'grid place-items-center h-screen' : (props.type === 'centered'),
        'absolute lg:top-20 top-14 w-full flex justify-center' : (props.type === 'scrollable'),
        'opacity-10 blur-sm' : props.fade
        }"
    >
      <slot />

    </main>
    <div v-if="!Object.values($page.props.flash).every(v => v===null)">
        <FlashMessage/>
    </div>

</template>