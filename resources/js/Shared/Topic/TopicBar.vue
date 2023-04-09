<script setup>

import { Link } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';
import ChevronDown from '@/Shared/SVG/ChevronDown.vue';
import TopicBlock from './TopicBlock.vue';
import TopicBarButtons from '@/Shared/Topic/TopicBarButtons.vue'

    defineProps({
        topic: Object
    });

    let showChildren = ref(false);

</script>

<template>

    <div
        class="rounded p-2 flex items-center relative"
    >
        <!-- Name Button-->

        <ChevronDown
                v-if="topic.children && topic.children.length > 0"
                width="20"
                height="20"
                @click="showChildren = ! showChildren"
                :class='{"-rotate-90" : !showChildren}'
                class="fill-white absolute -left-5"
        />

        <div class="truncate w-32 rounded px-2 py-1 text-center" :class="topic.background">
            {{ topic.name }}
        </div>
        <!-- Description -->
        <div class="text-base text-left hidden lg:inline ml-3 truncate w-auto">
            {{ topic.description }}
        </div>
        <TopicBarButtons :topic="topic"/>

    </div>

    <div v-if="showChildren" class="relative ml-2 lg:ml-10">
        <div>
            <TopicBlock
                :topics="topic.children"
            />
        </div>
    </div>


</template>