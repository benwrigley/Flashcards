<script setup>

    import Layout from '@/Shared/Layout.vue';
    import FlashcardGrid from '@/Shared/Flashcard/FlashcardGrid.vue';
    import CrossIcon from '@/Shared/SVG/CrossIcon.vue';
    import FlashcardCreateForm from '@/Shared/Flashcard/FlashcardCreateForm.vue';
    import FlashcardEditForm from '@/Shared/Flashcard/FlashcardEditForm.vue';
    import FlashcardDeleteForm from '@/Shared/Flashcard/FlashcardDeleteForm.vue';
    import FlashcardDeleteGroupForm from '@/Shared/Flashcard/FlashcardDeleteGroupForm.vue';
    import FlashcardMoveGroupForm from '@/Shared/Flashcard/FlashcardMoveGroupForm.vue';
    import Pagination from '@/Shared/Pagination.vue';
    import IconButton from '@/Shared/IconButton.vue';
    import { Link } from '@inertiajs/vue3';
    import { provide,ref } from 'vue';

    const props = defineProps({
        topic : {
            type: Object,
            require: true
        },
        flashcards: {
            type: Object
        },
        flashcardParents: {
            type: Object
        }
    });

    const showCreateFlashcardForm = ref(false);
    const showEditFlashcardForm = ref(false);
    const showDeleteFlashcardForm = ref(false);
    const showDeleteFlashcardGroupForm = ref(false);
    const showMoveFlashcardGroupForm = ref(false);
    const backgroundFade = ref(false);
    const currentTopic = ref(props.topic);
    const currentFlashcard = ref('');
    const selectedCards = ref([]);

    //providing ability for topic Bars to open/close and populate forms
    const toggleForms = {
        createFlashcard: () => {
            showCreateFlashcardForm.value = !showCreateFlashcardForm.value;
            backgroundFade.value = !backgroundFade.value;
        },
        editFlashcard: () => {
            showEditFlashcardForm.value = !showEditFlashcardForm.value;
            backgroundFade.value = !backgroundFade.value;
        },
        deleteFlashcard: () => {
            showDeleteFlashcardForm.value = !showDeleteFlashcardForm.value;
            backgroundFade.value = !backgroundFade.value;
        },
        deleteFlashcardGroup: () => {
            if (selectedCards.value.length > 0){
                showDeleteFlashcardGroupForm.value = !showDeleteFlashcardGroupForm.value;
                backgroundFade.value = !backgroundFade.value;
            }
        },
        moveFlashcardGroup: () => {
            if (selectedCards.value.length > 0){
                showMoveFlashcardGroupForm.value = !showMoveFlashcardGroupForm.value;
                backgroundFade.value = !backgroundFade.value;
            }
        },
    };

    provide('toggleForms', toggleForms);
    provide('currentTopic', currentTopic);
    provide('currentFlashcard', currentFlashcard);
    provide('selectedCards', selectedCards);

</script>

<template>
    <Layout :title="'Flashcards in ' + topic.name"  type="scrollable" :fade="backgroundFade" :navtitle="topic.name">
            <main class="rounded relative w-5/6">

                <div class="lg:flex items-baseline mb-16 relative hidden">

                    <div class=" bg-gray-800 rounded-3xl w-full p-2 p-6  items-center">
                        <div class="text-4xl">
                            <span>{{ topic.name }}</span> : <span class="text-sm lg:text-2xl font-mono italic mt-3"> '{{ topic.description }}' </span>
                        </div>
                                            <!-- close button-->
                        <div class="absolute lg:block lg:right-5 lg:top-5 right-4 top-1">
                            <Link :href="route('topics.home')">
                                <IconButton tooltip="Return to Topics">
                                    <CrossIcon width="30" height="30" class="fill-red-500"/>
                                </IconButton>
                            </Link>
                        </div>
                    </div>

                </div>



                <FlashcardGrid :flashcards="flashcards" />



        </main>

    </Layout>
    <Pagination class="absolute bottom-2 lg:hidden w-screen" :paginator="flashcards" />

    <FlashcardCreateForm v-if="showCreateFlashcardForm"/>
    <FlashcardEditForm v-if="showEditFlashcardForm"/>
    <FlashcardDeleteForm v-if="showDeleteFlashcardForm"/>
    <FlashcardDeleteGroupForm v-if="showDeleteFlashcardGroupForm" @close-form="toggleForms.deleteFlashcardGroup"/>
    <FlashcardMoveGroupForm v-if="showMoveFlashcardGroupForm" @close-form="toggleForms.moveFlashcardGroup" :possibleParents="flashcardParents"/>
</template>