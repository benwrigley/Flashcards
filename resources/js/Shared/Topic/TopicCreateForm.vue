<script setup>

    import {  useForm } from '@inertiajs/vue3';
    import { inject, provide, computed } from 'vue';
    import FormLayout from '@/Shared/Form/FormLayout.vue';
    import FormButton from '@/Shared/Form/FormButton.vue';
    import FormInput from '@/Shared/Form/FormInput.vue';
    import ColorPicker from '@/Shared/Form/ColorPicker.vue'


    defineProps({
        errors: Object,
    });

    const currentTopic = inject('currentTopic');

    let openTree = inject('openTree');


    const form = useForm({
        name: null,
        description: null,
        background: null,
        topic_id: Object.keys(currentTopic.value).length > 0 ? currentTopic.value.id : null
    })


    function submit(){
        form.post(
            route('topic.store'),
            {
                onSuccess: () => closeForm(),
                preserveState: true,
                preserveScroll: true,
        });

        if (Object.keys(currentTopic.value).length > 0){
            openTree.push(currentTopic.value.id);
        }
    }

    provide('form', form);


    const title = computed(() =>{
        return 'Create new ' + (Object.keys(currentTopic.value).length > 0 ? 'subtopic in ' + currentTopic.value.name : 'main topic');
    });

    const emit = defineEmits(['closeForm'])

    function closeForm(){
        emit('closeForm');
    };


</script>

<template>

<div class="fixed grid place-items-center h-screen w-screen">

    <FormLayout :title="title" @run-submission="submit" child="flex justify-center" :shadow="true" :closable="true" @close-form='closeForm()'>

        <div class="w-11/12 lg:w-4/6">
            <FormInput
                id="name"
                placeholder="Name"

            />
        </div>
        <div class="w-11/12 lg:w-4/6">
            <FormInput
                id="description"
                placeholder="Description"
                type="textarea"
                />
        </div>
        <div class="w-11/12 lg:w-4/6">
            <ColorPicker
                id="background" />
        </div>
        <div class="flex justify-around w-full">
            <FormButton
                label="Create Topic"
            />
        </div>
    </FormLayout>
    </div>
</template>