<script setup>

import { inject, ref, defineEmits} from 'vue';
import { useForm } from '@inertiajs/vue3';
import ChevronDown from '@/Shared/SVG/ChevronDown.vue';
import TopicBlock from './TopicBlock.vue';
import TopicBarButtons from '@/Shared/Topic/TopicBarButtons.vue'

    const props = defineProps({
        topic: Object
    });

    const open = ref(inject('openTree').includes(props.topic.id));
    const draggedItem = inject('draggedItem');

    const form = useForm({
        topic_id: null
    });

    //drag item login
    let childCount = 0;

    function childCounter(v){
        childCount += v;
    }

    function toggleOpen() {
        open.value = !open.value;
    }

    function dropHandler(e) {

        const draggedElement = document.getElementById(draggedItem.value);
        const thisElement = e.target;


        // prevent setting parent to self or child
        if (draggedElement.contains(thisElement)) {
            return;
        }

        form.topic_id = props.topic.id;
        form.put(route('topic.change.parent', {topic : draggedItem.value}));
    }

    function dragStartHandler(e,item){

        draggedItem.value = item;
        e.dataTransfer.effectAllowed="move";


    }

    function dragInside(b){
        if (b){
            childCounter(1);
        }
        else{
            childCounter(-1);
        }
        open.value = (childCount > 0);
    }


</script>

<template>

    <div
        :id="topic.id"
        draggable="true"
        @dragstart.stop="dragStartHandler($event,topic.id)"
        @drop.stop="dropHandler($event)"
        @dragover.prevent
        @dragenter="$emit('childCounter',1);dragInside(true)"
        @dragleave="$emit('childCounter',-1);dragInside(false)"
    >
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

        <div v-if="open && topic.children" class="relative ml-2 lg:ml-10">
            <TopicBlock
                @child-counter="childCounter"
                :topics="topic.children"
            />
        </div>
    </div>

</template>