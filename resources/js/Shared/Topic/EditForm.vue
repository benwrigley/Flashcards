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

    const currentTopic = inject('currentTopic');
    const toggleForms = inject('toggleForms');

    let openTree = inject('openTree');


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