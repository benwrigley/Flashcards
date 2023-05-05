<script setup>

    import { useForm } from '@inertiajs/vue3';
    import { inject, provide, computed} from 'vue';
    import FormLayout from '@/Shared/Form/FormLayout.vue';
    import FormButton from '@/Shared/Form/FormButton.vue';
    import FormInput from '@/Shared/Form/FormInput.vue';
    import ItemPicker from '@/Shared/Form/ItemPicker.vue'


    defineProps({
        errors: Object,
    });

    const currentFlashcard = inject('currentFlashcard');
    const toggleForms = inject('toggleForms');


    const form = useForm({
        question: currentFlashcard.value.question,
        answer: currentFlashcard.value.answer,
        max_score: currentFlashcard.value.max_score,
        topic_id: currentFlashcard.value.topic_id
    })


    function submit(){
        form.put(
            route('flashcard.update', {flashcard:currentFlashcard.value}),
            {
                onSuccess: () => closeForm(),
                preserveState: true,
                preserveScroll: true,
        });

    }

    provide('form', form);


    const title = computed(() =>{
        return 'Modifying flashcard';
    });


    function closeForm(){
        toggleForms.editFlashcard()
    }


</script>

<template>

<div class="fixed grid place-items-center h-screen w-screen">

    <FormLayout :title="title" @run-submission="submit" child="flex justify-center" :shadow="true" :closable="true" @close-form='closeForm()'>

        <FormInput
            id="question"
            placeholder="Question"
            type="textarea"
            />

        <FormInput
            id="answer"
            placeholder="Answer"
            type="textarea"
            />

        <ItemPicker
            id="max_score"
            label="Max Score:"
            itemClasses="rounded-full ring ring-gray-500 text-xl hover:bg-gray-500 p-2"
            unselected="bg-gray-600"
            selected="bg-blue-600"
            :items="Array.from({ length: 5 }, (_, index) => index + 1)"
        />

        <div class="flex justify-around w-full">
            <FormButton
                label="Update Flashcard"
            />
        </div>
    </FormLayout>
    </div>
</template>