<script setup>

    import TopicNew from '@/Shared/SVG/TopicNew.vue'
    import FlashcardNew from '@/Shared/SVG/FlashcardNew.vue'
    import IconButton from '@/Shared/IconButton.vue'
    import Edit from '@/Shared/SVG/Edit.vue'
    import Trash from '@/Shared/SVG/Trash.vue'
    import { Link } from '@inertiajs/vue3'
    import { inject } from 'vue'

    defineProps({
        topic: Object
    });

    const toggleForms = inject('toggleForms');
    const currentTopic = inject('currentTopic');


</script>


<template>

<div class=" fill-white absolute right-2 flex space-x-2 items-center" >
            <div
                class="text-base text-left hidden ml-3 truncate w-min lg:flex lg:items-center"
                v-if="topic.flashcards_count > 0 || topic.descendants.length < 1"
            >
                <div>
                    {{ topic.flashcards_count }}
                </div>
            </div>

            <!-- New Flashcard Button-->
            <div
                v-if="topic.flashcards_count > 0 || topic.descendants.length < 1"
                @click="currentTopic = topic; toggleForms.createFlashcard()"
            >

                <IconButton tooltip="New Flashcard">
                    <FlashcardNew width="20" height="20"/>
                </IconButton>

            </div>

            <!-- New Topic Button-->
            <div
                v-if="topic.descendants.length > 0 || topic.flashcards_count < 1"
                @click="currentTopic = topic; toggleForms.createTopic()"
            >
                <!-- <Link :href="route('topic.create',{topic:topic.id})"> -->
                    <IconButton tooltip="New Topic">
                        <TopicNew width="20" height="20"/>
                    </IconButton>
                <!-- </Link> -->
            </div>

            <!-- Edit Button-->
            <div
                @click="currentTopic = topic; toggleForms.editTopic()"
            >
                <IconButton tooltip="Edit Topic">
                    <Edit width="20" height="20"/>
                </IconButton>

            </div>

            <!-- Delete Button-->
            <div
                @click="currentTopic = topic; toggleForms.deleteTopic()"
            >

                <IconButton tooltip="Delete Topic">
                    <Trash width="20" height="20"/>
                </IconButton>

            </div>
        </div>

</template>