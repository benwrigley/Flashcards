<script setup>

    import Layout from '@/Shared/Layout.vue';
    import TopicBlock from '@/Shared/Topic/TopicBlock.vue'
    import CreateForm from '@/Shared/Topic/CreateForm.vue';
    import DeleteForm from '@/Shared/Topic/DeleteForm.vue';
    import FlashcardCreateForm from '@/Shared/Flashcard/FlashcardCreateForm.vue';
    import EditForm from '@/Shared/Topic/EditForm.vue';
    import IconButton from '@/Shared/IconButton.vue';
    import TopicNew from '@/Shared/SVG/TopicNew.vue';
    import { provide, ref, reactive } from 'vue';
    import { updateTopicParent } from '@/composables/updateTopicParent';

    const props = defineProps({
        topics: Array,
        openTree: {
            type:Array,
            default: () => []
        }
    });

    //Topic Forms
    const  showCreateTopicForm = ref(false);
    const  showDeleteTopicForm = ref(false);
    const  showEditTopicForm = ref(false);
    const  showCreateFlashcardForm = ref(false);
    const  currentTopic = ref({});
    const  backgroundFade = ref(false);
    const  draggedItem = ref(null);
    const  openTree = reactive(props.openTree)


    //providing ability for topic Bars to open/close and populate forms
    const toggleForms = {
        createTopic: () => {
        showCreateTopicForm.value = !showCreateTopicForm.value;
        backgroundFade.value = !backgroundFade.value;
        },
        deleteTopic: () => {
        showDeleteTopicForm.value = !showDeleteTopicForm.value;
        backgroundFade.value = !backgroundFade.value;
        },
        editTopic: () => {
        showEditTopicForm.value = !showEditTopicForm.value;
        backgroundFade.value = !backgroundFade.value;
        },
        createFlashcard: () => {
        showCreateFlashcardForm.value = !showCreateFlashcardForm.value;
        backgroundFade.value = !backgroundFade.value;
        },
    };


    provide('toggleForms', toggleForms);
    provide('currentTopic', currentTopic)

    //passing down tree of topics to have open at the start

    provide('openTree', openTree);

    //sharing the item currently being dragged - null to start
    provide('draggedItem',draggedItem);

    function dropHandler(){
        updateTopicParent(null,draggedItem.value);
    }



</script>

<template>
    <div @dragover.prevent @drop.prevent="dropHandler()" class="h-screen">
        <Layout title="Topics Index" type="scrollable" :fade="backgroundFade">

            <!-- Intro if no topics created -->
            <div v-if="topics.length < 1">
                <div class=" lg:p-2 lg:text-3xl text-center p-1 mb-10"> Hey {{ $page.props.auth.user.name }} - I see you are new to Flashcards. Welcome! </div>
                <div class="text-sm lg:text-xl lg:p-2 pl-4 lg:ml-14 inline-block lg:space-y-6 p-1 space-y-3">

                    <p class="bg-gray-800 rounded border border-emerald-600 w-full px-8 py-3">1. Start by adding a top-level topic like 'Maths' or 'History' at the bottom of this page.</p>

                    <p class="bg-gray-800 rounded border border-emerald-600 w-full px-8 py-3">2. Then you can create more top-level topics or click a the topic you just made to add sub-topics like 'Algebra' or 'Modern History'.</p>
                    <p class="bg-gray-800 rounded border border-emerald-600 w-full px-8 py-3">3. Keep adding as many topics/subtopics/subsubtopics and then add some flashcards.</p>
                    <p class="bg-gray-800 rounded border border-emerald-600 w-full px-8 py-3">4. At any point, visit a topic/subtopic that has flashcards and click the test me button!</p>
                </div>
            </div>
            <!-- Show the tree of all topics-->
            <div class="relative w-5/6 text-white  text-lg lg:text-xl">
                <TopicBlock :topics="topics" />
                <div
                    @click="currentTopic = {}; toggleCreateTopicForm()"
                    class="fill-white absolute right-2"
                >
                    <IconButton tooltip="New Main Topic">
                        <TopicNew width="20" height="20"/>
                    </IconButton>
                </div>
            </div>




        </layout>

        <!-- Create/Delete/Edit forms -->
        <CreateForm v-if="showCreateTopicForm"/>
        <DeleteForm v-if="showDeleteTopicForm"/>
        <EditForm v-if="showEditTopicForm"/>
        <FlashcardCreateForm v-if="showCreateFlashcardForm"/>
    </div>
</template>