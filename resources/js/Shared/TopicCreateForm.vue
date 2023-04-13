<script setup>

    import { router, useForm } from '@inertiajs/vue3';
    import { inject, provide, computed, onMounted, ref } from 'vue';
    import FormLayout from '@/Shared/FormLayout.vue';
    import FormButton from '@/Shared/FormButton.vue';
    import FormInput from '@/Shared/FormInput.vue';
    import ColorPicker from '@/Shared/Form/ColorPicker.vue'


    defineProps({
        errors: Object,
    });

    let {toggleCreateTopicForm,toggleDeleteTopicForm,currentTopic} = inject('toggleForms');


    const form = useForm({
        name: null,
        description: null,
        background: null,
        topic_id: currentTopic.value.id
    })

    function submit(){
        form.post(route('topic.store'),{
            onSuccess: () => toggleCreateTopicForm()
        });
    }

    provide('form', form);


    const title = computed(() =>{
        return 'Create new ' + (Object.keys(currentTopic).length === 0  ? 'main topic' : 'subtopic in ' + currentTopic.value.name);
    });

</script>

<template>

<div class="fixed grid place-items-center h-screen w-screen">

    <FormLayout :title="title" @run-submission="submit" child="flex justify-center" :shadow="true" :closable="true" @close-form='toggleCreateTopicForm()'>

        <FormInput
            id="name"
            placeholder="Name"

        />
        <FormInput
            id="description"
            placeholder="Description"
            type="textarea"
            />
        <ColorPicker
            id="background" />

        <div class="flex justify-around w-full">
            <FormButton
                label="Create Topic"
            />
        </div>
    </FormLayout>
    </div>
</template>