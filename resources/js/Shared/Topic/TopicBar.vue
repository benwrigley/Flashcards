<script setup>

import { inject, ref, defineEmits, watch} from 'vue';
import ChevronDown from '@/Shared/SVG/ChevronDown.vue';
import TopicBlock from './TopicBlock.vue';
import TopicBarButtons from '@/Shared/Topic/TopicBarButtons.vue'
import { updateTopicParent } from '@/composables/updateTopicParent';

    const props = defineProps({
        topic: Object
    });

    //managing which containers should be open
    const openTree = inject('openTree');

    const open = ref(openTree.includes(props.topic.id));

    watch(() => openTree, (newValue, oldValue) => {
        open.value = newValue.includes(parseInt(props.topic.id));
    }, {deep:true});


    //toggle the window when the user clicks the chevron
    function toggleOpen() {
        open.value = !open.value;
    }

    //keep track of whether we are currently dragging over a child so we know which one to open and close
    let childCount = 0;

    function childCounter(v){
        childCount += v;
    }


    //**DRAG AND DROP

    //store item currently dragging
    const draggedItem = inject('draggedItem');



    //when an element is dropped on this element check its not a child and then submit the update to backend
    function dropHandler(e) {

        const draggedElement = document.getElementById(draggedItem.value);
        const thisElement = e.target;


        // prevent setting parent to self or child
        if (draggedElement.contains(thisElement)) {
            return;
        }

        updateTopicParent(props.topic.id,draggedItem.value);
    }

    //store the dragged item
    function dragStartHandler(e,item){
        draggedItem.value = item;
    }

    //increment the counter when dragging over/leaving a child
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
                    v-if="topic.descendants && topic.descendants.length > 0"
                    width="20"
                    height="20"
                    @click="toggleOpen"
                    :class='{"-rotate-90" : !open}'
                    class="fill-white absolute -left-5"
            />

            <!-- Topic Name -->
            <div class="truncate w-40 rounded px-2 py-1 text-center" :class="topic.background">
                {{ topic.name }}
            </div>
            <!-- Topic Description -->
            <div class="text-base text-left hidden lg:inline ml-3 truncate w-auto">
                {{ topic.description }}
            </div>

            <TopicBarButtons :topic="topic"/>

        </div>

        <div v-show="open && topic.descendants" class="relative ml-2 lg:ml-10">
            <TopicBlock
                @child-counter="childCounter"
                :topics="topic.descendants"
            />
        </div>
    </div>

</template>