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
                onSuccess: () => closeForm(),
            },
        )
    };

    provide('form', form);


    const title = computed(() =>{
        return 'Edit topic ' + currentTopic.value.name;
    });

    onMounted(() => {
        router.reload({ only: ['topicParents'], data: { edittopic: currentTopic.value.id } })
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
            <FormSelect
                label="Parent Topic"
                id="topic_id"
                :items="topicParents"
                placeholder="This is a main topic"
            />
        </div>
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