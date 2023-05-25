<script setup>

    import {  useForm } from '@inertiajs/vue3';
    import { inject, provide, computed } from 'vue';
    import FormLayout from '@/Shared/Form/FormLayout.vue';
    import FormButton from '@/Shared/Form/FormButton.vue';
    import FormInput from '@/Shared/Form/FormInput.vue';
    import FormSelect from '../Form/FormSelect.vue';
    import FormError from '../Form/FormError.vue';


    defineProps({
        errors: Object,
    });

    const selectedTopics = inject('selectedTopics');


    const form = useForm({
        type:null,
        quantity: null,
        topics: null
    })


    function submit(){

        form.topics = selectedTopics.value;

        form.post(
            route('test.store'),
            {
                preserveState: true,
                preserveScroll: true,
        });
    }

    provide('form', form);

    const testTypes = [
        {id:1,name:'Shuffle the deck'},
        {id:2,name:'My worst ones'},
        {id:3,name:'My least tested'},
    ];

    const emit = defineEmits(['closeForm'])

    function closeForm(){
        emit('closeForm');
    };



</script>


<template>
    <div class="rounded-2xl p-2 shadow-2xl shadow-blue-500 lg:mb-20 mb-3 bg-gray-800">

    <FormLayout @run-submission="submit" :shadow="false" :closable="true" :box="false" @close-form='closeForm()' :fullwidth="true" class="w-full">

        <div class="lg:flex lg:justify-around lg:items-center space-y-2">
            <div >
                <div>
                    <p >Select Topics/Subtopics Below : <span :class="{'text-red-500' : selectedTopics.length === 0}">{{ selectedTopics.length }}</span></p>
                </div>
                <div>
                    <FormError v-if="form.errors['topics']">
                        {{ form.errors['topics'] }}
                    </FormError>
                </div>
            </div>


            <div class="pt-2" >
                <FormSelect
                        id="type"
                        :items="testTypes"
                        placeholder="Select test type"
                    />
            </div>

            <div>
                <FormInput
                    id="quantity"
                    placeholder="How many cards?"
                />
            </div>

            <div class="text-center">
                <FormButton
                    class="bg-blue-500 "
                    label="Test me!"
                />
            </div>
        </div>
    </FormLayout>
    </div>
</template>