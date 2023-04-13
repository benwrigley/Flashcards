<script setup>

    import TopicBar from '@/Shared/Topic/TopicBar.vue'

    defineProps({
        topics: Array,
    });

</script>

<template>

    <!-- Show a topic bar for each topic -->
    <div v-for="topic in topics" class="w-full pb-2">
        <div class="shadow-sm shadow-gray-700">
            <TopicBar :topic="topic" />
        </div>
    </div>



</template>