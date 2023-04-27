<script setup>

    import { router, useForm } from '@inertiajs/vue3';
    import { inject, provide, computed, onMounted, ref } from 'vue';
    import FormLayout from '@/Shared/Form/FormLayout.vue';
    import FormButton from '@/Shared/Form/FormButton.vue';
    import FormInput from '@/Shared/Form/FormInput.vue';
    import ColorPicker from '@/Shared/Form/ColorPicker.vue'
    import FormSelect from '../Form/FormSelect.vue';


    const props = defineProps({
        errors: Object,
        topicParents : Object
    });

    const currentTopic = inject('currentTopic');
    const toggleForms = inject('toggleForms');


    const form = useForm({
        name: currentTopic.value.name,
        description: currentTopic.value.description,
        background: currentTopic.value.background,
        topic_id: currentTopic.value.topic_id
    });

    function submit(){
        form.put(
            route("topic.update", {topic:currentTopic.value}),
            {
                preserveState: true,
                preserveScroll: true,
                onSuccess: () => toggleForms.editTopic(),
            },
        )
    };

    provide('form', form);


    const title = computed(() =>{
        return 'Edit topic ' + currentTopic.value.name;
    });


    const parentTopics = computed(() =>{
        props.topicParents.unshift({id: null, name: 'This is a main topic'});
        return props.topicParents;
    });

    onMounted(() => {
        router.reload({ only: ['topicParents'], data: { edittopic: currentTopic.value.id } })
    });


</script>

<template>

<div class="fixed grid place-items-center h-screen w-screen">

    <FormLayout :title="title" @run-submission="submit" child="flex justify-center" :shadow="true" :closable="true" @close-form='toggleForms.editTopic()'>

        <FormInput
            id="name"
            placeholder="Name"

        />
        <FormInput
            id="description"
            placeholder="Description"
            type="textarea"
            />
        <FormSelect
            label="Parent Topic"
            id="topic_id"
            :items="parentTopics"
        />
        <ColorPicker
            id="background" />

        <div class="flex justify-around w-full">
            <FormButton
                label="Update Topic"
            />
        </div>
    </FormLayout>
    </div>
</template>