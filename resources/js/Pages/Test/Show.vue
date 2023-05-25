<script setup>

    import {  useForm } from '@inertiajs/vue3';
    import Layout from '@/Shared/Layout.vue';
    import CrossIcon from '@/Shared/SVG/CrossIcon.vue';
    import FlashcardEditForm from '@/Shared/Flashcard/FlashcardEditForm.vue';
    import FlashcardDeleteForm from '@/Shared/Flashcard/FlashcardDeleteForm.vue';
    import IconButton from '@/Shared/IconButton.vue';
    import { Link } from '@inertiajs/vue3';
    import { provide,ref,computed, watch } from 'vue';
    import FormInput from '@/Shared/Form/FormInput.vue';
    import FormButton from '@/Shared/Form/FormButton.vue';
    import ItemPicker from '@/Shared/Form/ItemPicker.vue';
    import { setFlashMessage } from '@/composables/setFlashMessage';
    import Edit from '@/Shared/SVG/Edit.vue';
    import Trash from '@/Shared/SVG/Trash.vue';

    const props = defineProps({
        test : {
            type: Object,
            required: true
        },
        currentFlashcard: {
            type: Object,
            required : true
        },
        position: {
            type: Number,
            default: 0
        },
        total: {
            required: true,
            type: Number,
            default: 0
        }
    });

    const currentForm =ref(null);
    const questionMode = ref(true);
    const currentCard = ref(props.currentFlashcard);

    const form = useForm({
        test: props.test.id,
        flashcard: null,
        answer:null,
        score:null
    })


    function submit(){

        form.flashcard = props.currentFlashcard.id;
        questionMode.value = true;

        form.post(
            route('test.answer'),
            {
                preserveState: true,
                preserveScroll: true,
                onSuccess: () => nextCard()
            }
        );
    }

    function nextCard(){
        form.answer = null;
        form.score = null;
    }


    const backgroundFade = computed(() => {
        return currentForm.value !== null;
    });

    const ended = computed(() => {
        return props.position === null;
    });

    const finalScore = computed(() => {
        return ((props.test.final_score / props.test.max_score) *100).toFixed(1);
    });


    watch(
        () => props.currentFlashcard,
        (newCurrentFlashcard) => {
            currentCard.value = newCurrentFlashcard;
        },
        { immediate: true }
    );


    provide('currentFlashcard', currentCard);
    provide('form', form);

    function closeForms(){
        form.reset();
        questionMode.value = true;
        currentForm.value = null;
    }

    function checkAnswer(){
        if (form.answer !== null){
            questionMode.value = ! questionMode.value;
        }
        else{
            setFlashMessage('error','Please fill in an answer first');
        }
    }

</script>

<style>
.fade-enter-active{
    transition: opacity 0.5s ease;
}
.fade-leave-active {
  transition: opacity 0.5s; /* Duration of the fade animation */
}

.fade-enter{
    transition: opacity 0.5s ease;
}
.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style>

<template>
    <Layout title="Test" type="scrollable" :fade="backgroundFade" navtitle="Test">
            <main class="rounded w-4/6 text-center">

                <div class="flex justify-between px-2 w-full items-center">
                    <div class="italic text-gray-400">
                        <p v-if="!ended">Card {{  position + 1  }} of {{ total }} :</p>
                        <p v-else>Score {{  test.final_score }} of {{test.max_score }}</p>
                    </div>
                    <div>
                        <Link :href="route('topics.home')">
                                <IconButton tooltip="Leave test">
                                    <CrossIcon width="30" height="30" class="fill-red-500"/>
                                </IconButton>
                            </Link>
                    </div>
                </div>

                <div class="mt-10" >
                    <transition name="fade" mode="out-in" appear>
                        <div v-if="questionMode && !ended"  class="flex flex-col justify-center items-center ">
                            <div class="rounded-3xl w-4/6  items-center shadow-2xl shadow-blue-500 italic mb-20 bg-gray-800 p-6]">
                                <div class="text-4xl p-6 h-96 items-center justify-center flex">
                                    <p>"{{ currentFlashcard.question }}"</p>
                                </div>
                            </div>

                            <div class="w-5/6">
                                <FormInput type="textarea" placeholder="And the answer is ...?" id="answer" :dark="true" rows="5"/>
                            </div>
                            <div v-if="form.answer" class=" mt-8">
                                <FormButton label="Show Answer" class="bg-blue-600" type="button" @clicked="checkAnswer" />
                            </div>

                        </div>



                        <!-- Answer Section-->

                        <div v-else-if="!questionMode && !ended" class="flex flex-col justify-center items-center">
                            <div class="relative rounded-3xl w-4/6 items-center shadow-2xl shadow-blue-500 italic mb-20 bg-gray-800 p-6">
                                <div class="text-4xl p-6 h-96 flex items-center justify-center">
                                    "{{ currentFlashcard.answer }}"
                                </div>
                                <div class="absolute right-8 top-6 flex space-x-2 fill-white">
                                    <!-- Edit Button-->
                                    <div
                                        @click.stop="currentForm='editFlashcard'"
                                        class="hidden lg:block"
                                    >
                                        <IconButton tooltip="Edit Flashcard">
                                            <Edit width="20" height="20"/>
                                        </IconButton>

                                    </div>

                                    <!-- Delete Button-->
                                    <div
                                        @click.stop="currentForm='deleteFlashcard'"
                                        class="hidden lg:block"
                                    >

                                        <IconButton tooltip="Delete Flashcard">
                                            <Trash width="20" height="20"/>
                                        </IconButton>

                                    </div>
                                </div>
                            </div>

                            <div class="rounded bg-gray-800 w-5/6 items-center text-3xl p-6 border">
                                {{  form.answer }}
                            </div>

                            <div class="w-full flex mt-10 italic ">
                                <ItemPicker
                                    id="score"
                                    label="How did you do?:"
                                    itemClasses="p-3  rounded-full hover:shadow-xl hover:shadow-blue-500"
                                    unselected="bg-gray-800"
                                    selected="bg-blue-600"
                                    @clicked="submit"
                                    :items="Array.from({ length: currentFlashcard.max_score + 1 }, (_, index) => index)"
                                />

                            </div>

                        </div>

                        <!-- results section-->

                        <div v-else class="flex flex-col justify-center items-center space-y-6">
                            <div class="rounded-3xl w-1/3 items-center italic">
                                <div
                                    class="text-8xl p-6 shadow-2xl shadow-blue-500 rounded-xl bg-gray-800 py-24 "
                                    :class="{
                                        'text-red-700 shadow-red-700' : finalScore <=30,
                                        'text-green-500 shadow-green-500' : finalScore > 60 && finalScore < 100,
                                        'text-orange-400 shadow-orange-400' : finalScore > 30 && finalScore <= 60,
                                        'text-green-500 shadow-green-500 animate-ping' : finalScore == 100,

                                    }"
                                    >
                                            {{ finalScore }} %
                                </div>
                            </div>

                        </div>
                    </transition>

                </div>





        </main>

    </Layout>

    <FlashcardEditForm v-if="currentForm === 'editFlashcard'" @close-form="closeForms"/>
    <FlashcardDeleteForm v-if="currentForm === 'deleteFlashcard'" @close-form="closeForms"/>

</template>