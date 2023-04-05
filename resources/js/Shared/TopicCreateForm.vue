<script setup>

    import { useForm } from '@inertiajs/vue3';
    import { provide } from 'vue';
    import FormLayout from '@/Shared/FormLayout.vue';
    import FormButton from '@/Shared/FormButton.vue';
    import FormInput from '@/Shared/FormInput.vue';

    defineProps({ errors: Object })

    const form = useForm({
    email: null,
    password: null,
    })

    provide('form', form);

</script>

<template>

<FormLayout method="post" :routeName="route('login')" class="flex justify-center">
                <FormInput
                    id="name"
                    placeholder="Name"

                />
                <FormInput
                    id="description"
                    placeholder="description"
                    />

                <div class="flex justify-around w-full">
                    <FormButton
                        type="button"
                        label="Forgot Password"
                        class="bg-gray-900 text-gray-500"
                        :link="route('password.request')"
                    />
                    <FormButton
                        label="Login"
                    />
                </div>
        </FormLayout>
</template>