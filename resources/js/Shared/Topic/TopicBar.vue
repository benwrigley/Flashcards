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

    const testMode = inject('testMode');
    const selectedTopics = inject('selectedTopics');

    //get a list of child ids one level down
    const childIds = props.topic.descendants ? props.topic.descendants.map(topic => topic.id) : null;


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

    function toggleTopicSelect(){

        if (!testMode.value){
            return;
        }

        let index = selectedTopics.value.indexOf(props.topic.id);

        if (index !== -1){
            selectedTopics.value.splice(index,1);
        }
        else{
            selectedTopics.value.push(props.topic.id);
        }
    }

    const amISelected = computed(() => {
        return selectedTopics.value.includes(props.topic.id);
    })

    watch(amISelected, (newValue) => {
        if (newValue){
            selectedTopics.value = selectedTopics.value.concat(childIds);
        }
        else{
           selectedTopics.value = selectedTopics.value.filter(topic => !childIds.includes(topic));
        }

    });

    const additionalClass = computed(() => {

        if (amISelected.value){
            return "bg-blue-200 bg-opacity-40 rounded"
        }
        else if (childCount.value > 0 && props.topic.flashcards_count > 0 && draggedItem.value !== props.topic.id){
            return "filter grayscale opacity-40 ";
        }
        return "";
    });

</script>

<template>

    <div
        :id="topic.id"
        :draggable="!testMode"
        @dragstart.stop="dragStartHandler($event,topic.id)"
        @drop.stop="dropHandler($event)"
        @dragover.prevent
        @dragenter="$emit('childCounter',1);dragEnterHandler($event)"
        @dragleave="$emit('childCounter',-1);dragLeaveHandler($event)"
        @touchstart.stop="dragStartHandler($event,topic.id)"
        :class="additionalClass"
        class=""
        @click.stop="toggleTopicSelect"
    >
        <div class="rounded p-2 flex items-center relative">
            <div class="w-5">
            <ChevronDown
                    v-if="topic.descendants && topic.descendants.length > 0"
                    width="20"
                    height="20"
                    @click.stop="toggleOpen"
                    :class='{"-rotate-90" : !open, "fill-white" : !testMode, "fill-blue-500" : testMode}'
            />
            </div>

            <!-- Topic Name -->

            <LinkButton v-if="topic.flashcards_count > 0 && !testMode" :link="route('topic.show',[topic.slug])" :label="topic.name" :class="'truncate w-32 lg:w-40 rounded px-2 py-1 text-center ' + topic.background"/>
            <div v-else
                class="truncate  rounded px-2 py-1 text-center duration-500"
                :class="{
                    [topic.background]:true,
                    'bg-opacity-70 w-full lg:w-80':testMode,
                    'w-32 lg:w-40':!testMode
                    }">
                {{ topic.name }}
            </div>

            <!-- Topic Description -->
            <div class="text-base text-left hidden lg:inline ml-3 truncate w-auto">
                {{ topic.description }}
            </div>

            <TopicBarButtons v-if="!testMode" :topic="topic"/>

        </div>

        <div v-show="open && topic.descendants" class="relative ml-2 lg:ml-10">
            <TopicBlock
                @child-counter="childCounter"
                :topics="topic.descendants"
            />
        </div>
    </div>

</template>