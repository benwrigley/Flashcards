<script setup>

    import Layout from '@/Shared/Layout.vue';
    import TopicBlock from '@/Shared/Topic/TopicBlock.vue'
    import TopicCreateForm from '@/Shared/TopicCreateForm.vue';
    import TopicDeleteForm from '@/Shared/TopicDeleteForm.vue';
    import { provide, ref, reactive, onMounted, watch } from 'vue';

    const props = defineProps({
        topics: Array,
        openTree: {
            type:Array,
            default: []
        }
    });

    //Topic Forms
    let showCreateTopicForm = ref(false);
    let showDeleteTopicForm = ref(false);
    let currentTopic = ref(null);
    let backgroundFade = ref(false);
    let draggedItem = ref(null);


    function toggleCreateTopicForm(){
        showCreateTopicForm.value = ! showCreateTopicForm.value;
        backgroundFade.value = ! backgroundFade.value;
    }

    function toggleDeleteTopicForm(){
        showDeleteTopicForm.value = ! showDeleteTopicForm.value;
        backgroundFade.value = ! backgroundFade.value;
    }



    //providing ability for topic Bars to open/close and populate forms
    provide('toggleForms', {
        toggleCreateTopicForm,
        toggleDeleteTopicForm,
        currentTopic
    });

    //passing down tree of topics to have open at the start
    const openTree = reactive(props.openTree)
    provide('openTree', openTree);

    //sharing the item currently being dragged - null to start
    provide('draggedItem',draggedItem);


</script>

<template>
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
        <div class="w-5/6 text-white  text-lg lg:text-xl">
            <TopicBlock :topics="topics" />
        </div>


    </layout>

    <!-- Create/Delete/Edit forms -->
    <TopicCreateForm v-if="showCreateTopicForm"/>
    <TopicDeleteForm v-if="showDeleteTopicForm"/>
</template>