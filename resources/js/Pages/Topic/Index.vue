<script setup>

    import Layout from '@/Shared/Layout.vue';
    import TopicButton from '@/Shared/TopicButton.vue';
    import TopicCreateForm from '@/Shared/TopicCreateForm.vue';


    defineProps({
        topics: Array
    });

</script>

<template>
    <Layout title="Topics Index">

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

        <!--  Topic Grid if there are any-->
        <div v-else class="grid grid-cols-3 text-center lg:w-4/6">
            <div v-for="topic in topics">

                <TopicButton
                    :label="topic.name"
                    :description="topic.description"
                    :href="'/topics/' + topic.slug"
                    :class="(topic.background || 'bg-gray-600')"
                />

            </div>
        </div>

        <!-- New Topic form -->

        <TopicCreateForm />



    </layout>
</template>