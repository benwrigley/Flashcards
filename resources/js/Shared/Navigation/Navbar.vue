<script setup>

    import Streak from '@/Shared/Navigation/Streak.vue';
    import ControlPanel from '@/Shared/Navigation/ControlPanel.vue';

</script>

<template>
    <nav class="bg-gray-800 p-2 flex  items-center justify-between fixed w-screen left-0 top-0 uppercase text-sm lg:text-lg">
        <Streak />
        <ControlPanel />
    </nav>

</template>