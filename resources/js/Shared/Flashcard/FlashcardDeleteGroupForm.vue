<script setup>

    import { useForm } from '@inertiajs/vue3';
    import { inject, provide} from 'vue';
    import FormLayout from '@/Shared/Form/FormLayout.vue';
    import FormButton from '@/Shared/Form/FormButton.vue';
    import WarningTriangle from '@/Shared/SVG/WarningTriangle.vue';


    defineProps({
        errors: Object,
    });

    const selectedCards = inject('selectedCards');


    const form = useForm({})

    function submit(){
        console.log('here');
        form.delete(route('flashcard.destroy.group',{flashcards : selectedCards.value}),{
            onSuccess: () => closeForm()
        });
    }

    const emit = defineEmits(['closeForm'])

    function closeForm(){
        emit('closeForm');
    };


    provide('form', form);

</script>

<template>

<div class="fixed grid place-items-center h-screen w-screen">

    <FormLayout
        :title="'Deleting ' + selectedCards.length + ' Flashcards'"
        @run-submission="submit"
        child="flex justify-center"
        :shadow="true"
        :closable="true"
        @close-form="closeForm()">


        <div>
            <div class="flex justify-center items-center space-x-4 mb-4">
                <WarningTriangle width="30" height="30" class="fill-red-500"/>
                <p>This cannot be undone. Are you sure?</p>
            </div>

            <div class="flex justify-around w-full mt-6" >
                <FormButton
                @click="closeForm()"
                    type="button"
                    label="Cancel"
                />

                <FormButton
                    label="Delete"
                    class="bg-red-900 text-white"
                />
            </div>
        </div>

    </FormLayout>
    </div>
</template>