<script setup>

    import { useForm } from '@inertiajs/vue3';
    import { inject, provide, computed} from 'vue';
    import FormLayout from '@/Shared/FormLayout.vue';
    import FormButton from '@/Shared/FormButton.vue';
    import WarningTriangle from '@/Shared/SVG/WarningTriangle.vue';


    defineProps({
        errors: Object,
    });

    const currentTopic = inject('currentTopic');
    const toggleForms = inject('toggleForms');


    const form = useForm({
        name: null,
        description: null,
        background: null,
        topic_id: currentTopic.value.id
    })

    function submit(){
        form.delete(route('topic.destroy',{topic : currentTopic.value.id}),{
            onSuccess: () => toggleForms.deleteTopic()
        });
    }

    provide('form', form);

    const cannotBeDeleted = computed(() =>{

        return (currentTopic.value.descendants.length > 0 || currentTopic.value.flashcards_count > 0);
    });

    const title = computed(() =>{

        return cannotBeDeleted.value ?  'Cannot delete ' + currentTopic.value.name : 'Deleting ' + currentTopic.value.name;
    });

</script>

<template>

<div class="fixed grid place-items-center h-screen w-screen">

    <FormLayout :title="title" @run-submission="submit" child="flex justify-center" :shadow="true" :closable="true" @close-form='toggleForms.deleteTopic()'>

        <div

         v-if="cannotBeDeleted">
            <div class="pb-4 text-xl text-center">
                <p>Please delete all subtopics and flashcards before this can be deleted.</p>
            </div>

            <div class="flex justify-around w-full" @click="toggleForms.deleteTopic()">
                <FormButton
                    type="button"
                    label="Cancel"
                />
            </div>
        </div>


        <div
            v-else>
            <div class="flex justify-center items-center space-x-4 mb-4">
                <WarningTriangle width="30" height="30" class="fill-red-500"/>
                <p>This cannot be undone. Are you sure?</p>
            </div>

            <div class="flex justify-around w-full mt-6" >
                <FormButton
                @click="toggleForms.deleteTopic()"
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