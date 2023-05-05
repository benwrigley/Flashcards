<script setup>

    import IconButton from '@/Shared/IconButton.vue'
    import Edit from '@/Shared/SVG/Edit.vue'
    import Trash from '@/Shared/SVG/Trash.vue'
    import ArrowMove from '@/Shared/SVG/ArrowMove.vue'
    import FormCheckbox from '@/Shared/Form/FormCheckbox.vue'
    import FlashcardNew from '@/Shared/SVG/FlashcardNew.vue'
    import Pagination from '@/Shared/Pagination.vue'
    import { inject, onMounted } from 'vue'

    defineProps({
        flashcards : {
            type:Object
        }
    })

    const currentTopic = inject('currentTopic');
    const currentFlashcard = inject('currentFlashcard');
    const toggleForms = inject('toggleForms');
    const selectedCards = inject('selectedCards')

    function toggleCardSelect(n){
        let index = selectedCards.value.indexOf(n);

        if (index !== -1){
            selectedCards.value.splice(index,1);
        }
        else{
            selectedCards.value.push(n);
        }
    }

    onMounted(() => {
        selectedCards.value=[];
    });

</script>
<template>

    <!-- Header -->
        <div class="flex justify-between lg:grid lg:grid-cols-3 mb-3 items-center mt-2">
            <div class="flex fill-white space-x-2 place-content-start">
                <div
                        @click="toggleForms.createFlashcard"
                >
                    <IconButton tooltip="New Flashcard">
                        <FlashcardNew width="20" height="20"/>
                    </IconButton>
                </div>
                <div
                    @click="toggleForms.deleteFlashcardGroup()"
                >

                    <IconButton tooltip="Delete Selected">
                        <Trash width="20" height="20"/>
                    </IconButton>

                </div>
                <div
                    @click="toggleForms.moveFlashcardGroup()"
                >

                    <IconButton tooltip="Move Selected">
                        <ArrowMove width="20" height="20"/>
                    </IconButton>

                </div>
            </div>
            <div class="flex italic text-base place-content-center">
                 {{ flashcards.from }} - {{ flashcards.to }} of {{ flashcards.total }}
            </div>
            <Pagination class="mt-6 place-content-end lg:flex hidden" :paginator="flashcards" />
        </div>
        <!-- /Header-->


        <div v-for="flashcard in flashcards.data"
            class="relative flex items-center bg-gray-700 rounded-lg p-2 mb-3 hover:border text-sm lg:text-xl"
            :class="{
                'border border-blue-500' : selectedCards.includes(flashcard.id)
            }"
            :key="flashcard.id"
            @click="currentFlashcard = flashcard; toggleForms.editFlashcard()"
        >

            <div class="flex ml-4">
                <FormCheckbox :id="flashcard.id" @option-selected="toggleCardSelect"/>
                <div class="italic ml-6 truncate w-52 lg:w-full">
                    '{{ flashcard.question}}'
                </div>

            </div>

            <div class="col-span-1 space-x-2 fill-white right-2 absolute flex">
                <div class="mr-3">
                    {{flashcard.avg_score}}%
                </div>
            <!-- Edit Button-->
                <div
                    @click.stop="currentFlashcard = flashcard; toggleForms.editFlashcard()"
                    class="hidden lg:block"
                >
                    <IconButton tooltip="Edit Flashcard">
                        <Edit width="20" height="20"/>
                    </IconButton>

                </div>

                <!-- Delete Button-->
                <div
                    @click.stop="currentFlashcard = flashcard; toggleForms.deleteFlashcard()"
                    class="hidden lg:block"
                >

                    <IconButton tooltip="Delete Flashcard">
                        <Trash width="20" height="20"/>
                    </IconButton>

                </div>
            </div>
        </div>

</template>