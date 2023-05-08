<script setup>

    import TopicNew from '@/Shared/SVG/TopicNew.vue'
    import FlashcardNew from '@/Shared/SVG/FlashcardNew.vue'
    import IconButton from '@/Shared/IconButton.vue'
    import Edit from '@/Shared/SVG/Edit.vue'
    import Trash from '@/Shared/SVG/Trash.vue'
    import { inject } from 'vue'

    const props = defineProps({
        topic: Object
    });

    const currentForm = inject('currentForm');
    const currentTopic = inject('currentTopic')

    function openForm(formName){

        currentForm.value=formName;
        currentTopic.value = props.topic;
    }


</script>


<template>

<div class=" fill-white absolute right-2 flex space-x-2 items-center" >
            <div
                class="text-base text-left ml-3 truncate w-min lg:flex lg:items-center"
                v-if="topic.flashcards_count > 0 && topic.descendants.length < 1"
            >
                <div>
                    {{ topic.flashcards_count }}
                </div>
            </div>

            <!-- New Flashcard Button-->
            <div
                v-if="topic.flashcards_count > 0 || topic.descendants.length < 1"
                @click="openForm('createFlashcard')"
            >

                <IconButton tooltip="New Flashcard">
                    <FlashcardNew width="20" height="20"/>
                </IconButton>

            </div>

            <!-- New Topic Button-->
            <div
                v-if="topic.descendants.length > 0 || topic.flashcards_count < 1"
                @click="openForm('createTopic')"
            >
                <!-- <Link :href="route('topic.create',{topic:topic.id})"> -->
                    <IconButton tooltip="New Topic">
                        <TopicNew width="20" height="20"/>
                    </IconButton>
                <!-- </Link> -->
            </div>

            <!-- Edit Button-->
            <div
                @click="openForm('editTopic')"
            >
                <IconButton tooltip="Edit Topic">
                    <Edit width="20" height="20"/>
                </IconButton>

            </div>

            <!-- Delete Button-->
            <div
                @click="openForm('deleteTopic')"
            >

                <IconButton tooltip="Delete Topic">
                    <Trash width="20" height="20"/>
                </IconButton>

            </div>
        </div>

</template>