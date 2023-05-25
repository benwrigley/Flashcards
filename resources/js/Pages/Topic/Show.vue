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
    import { provide,ref,computed } from 'vue';
    import { convertColour } from '@/composables/convertColour';

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

    const currentTopic = ref(props.topic);
    const currentFlashcard = ref('');
    const selectedCards = ref([]);
    const currentForm = ref(null);

    const backgroundFade = computed(() => {
        return currentForm.value !== null;
    });

    const shadowColour = convertColour(props.topic.background,'shadow-')

    provide('currentTopic', currentTopic);
    provide('currentFlashcard', currentFlashcard);
    provide('selectedCards', selectedCards);
    provide('currentForm',currentForm);

    function closeForms(){
        currentForm.value = null;
    }

</script>

<template>
    <Layout :title="'Flashcards in ' + topic.name"  type="scrollable" :fade="backgroundFade" :navtitle="topic.name">
            <main class="rounded relative w-5/6">

                <div class=" lg:flex items-baseline mb-16 relative hidden " >

                    <div class="bg-gray-800 rounded-3xl w-full p-6  items-center shadow-2xl" :class="shadowColour">
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
    <Pagination class="fixed bottom-3 lg:hidden w-full" :paginator="flashcards" />
    <FlashcardCreateForm v-if="currentForm === 'createFlashcard'" @close-form="closeForms"/>
    <FlashcardEditForm v-if="currentForm === 'editFlashcard'" @close-form="closeForms"/>
    <FlashcardDeleteForm v-if="currentForm === 'deleteFlashcard'" @close-form="closeForms"/>
    <FlashcardDeleteGroupForm v-if="currentForm === 'deleteFlashcardGroup'" @close-form="closeForms"/>
    <FlashcardMoveGroupForm v-if="currentForm === 'moveFlashcardGroup'" @close-form="closeForms" :possibleParents="flashcardParents"/>
</template>