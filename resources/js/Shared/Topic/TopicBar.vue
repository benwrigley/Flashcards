<script setup>

import { computed, inject, ref} from 'vue';
import ChevronDown from '@/Shared/SVG/ChevronDown.vue';
import TopicBlock from './TopicBlock.vue';
import TopicBarButtons from '@/Shared/Topic/TopicBarButtons.vue'

    const props = defineProps({
        topic: Object
    });


    const open = ref(inject('openTree').includes(props.topic.id));

    function toggleOpen() {
        open.value = !open.value;
    }


</script>

<template>

    <div class="rounded p-2 flex items-center relative">

        <ChevronDown
                v-if="topic.children && topic.children.length > 0"
                width="20"
                height="20"
                @click="toggleOpen"
                :class='{"-rotate-90" : !open}'
                class="fill-white absolute -left-5"
        />

        <!-- Topic Name -->
        <div class="truncate w-32 rounded px-2 py-1 text-center" :class="topic.background">
            {{ topic.name }}
        </div>
        <!-- Topic Description -->
        <div class="text-base text-left hidden lg:inline ml-3 truncate w-auto">
            {{ topic.description }}
        </div>

        <TopicBarButtons :topic="topic"/>

    </div>

    <div v-if="open" class="relative ml-2 lg:ml-10">
        <div>
            <TopicBlock
                :topics="topic.children"
            />
        </div>
    </div>


</template>