<script setup>

import { inject, ref, watch, computed} from 'vue';
import ChevronDown from '@/Shared/SVG/ChevronDown.vue';
import TopicBlock from './TopicBlock.vue';
import TopicBarButtons from '@/Shared/Topic/TopicBarButtons.vue'
import { updateTopicParent } from '@/composables/updateTopicParent';
import LinkButton from '@/Shared/Form/LinkButton.vue';

    const props = defineProps({
        topic: Object
    });

    //keep track of whether we are currently dragging over a child so we know which one to open and close
    let childCount = ref(0);

    function childCounter(v){
        childCount.value += v;
        open.value = (childCount.value > 0);
    }

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




    //**DRAG AND DROP

    //store item currently dragging
    const draggedItem = inject('draggedItem');



    //when an element is dropped on this element check its not a child and then submit the update to backend
    function dropHandler(e) {

        childCount.value=0;

        const draggedElement = document.getElementById(draggedItem.value);
        const thisElement = e.target;

        // prevent setting parent to self or child
        if (draggedElement.contains(thisElement)) {

            return;
        }

        if (props.topic.flashcards_count > 0){
            return;
        }

        updateTopicParent(props.topic.id,draggedItem.value);
    }

    //store the dragged item
    function dragStartHandler(e,item){
        draggedItem.value = item;
    }

    function dragEnterHandler(e){
        childCounter(1);

    }

    function dragLeaveHandler(e){
        childCounter(-1);

    }


    const additionalClass = computed(() => {
        if (childCount.value > 0 && props.topic.flashcards_count > 0 && draggedItem.value !== props.topic.id){
                return "filter grayscale opacity-40 ";
        }
        return "";
    });


</script>

<template>

    <div
        :id="topic.id"
        draggable="true"
        @dragstart.stop="dragStartHandler($event,topic.id)"
        @drop.stop="dropHandler($event)"
        @dragover.prevent
        @dragenter="$emit('childCounter',1);dragEnterHandler($event)"
        @dragleave="$emit('childCounter',-1);dragLeaveHandler($event)"
        @touchstart.stop="dragStartHandler($event,topic.id)"
        :class="additionalClass"
        class=""
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
            <LinkButton v-if="topic.flashcards_count > 0" :link="route('topic.show',[topic.slug])" :label="topic.name" :class="'truncate w-32 lg:w-40 rounded px-2 py-1 text-center ' + topic.background"/>
            <div v-else class="truncate w-32 lg:w-40 rounded px-2 py-1 text-center duration-500" :class="topic.background">
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