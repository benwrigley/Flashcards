<script setup>

    import { provide } from 'vue'
    import { useForm } from '@inertiajs/vue3'

    import Layout from '@/Shared/Layout.vue'
    import FormLayout from '@/Shared/FormLayout.vue'
    import FormInput from '@/Shared/FormInput.vue'
    import FormButton from '@/Shared/FormButton.vue'
    import LinkButton from '@/Shared/LinkButton.vue'


    const form = useForm({
        email: null
    });

    provide('form', form);


</script>


<template>
    <Layout title="Forgot Password">
        <FormLayout title="Enter your email to reset your password" method="post" :routeName="route('password.email')">

            <FormInput
                id="email"
                placeholder="Enter Email Address"
                class="lg:w-2/3 w-3/4 mt-3 mb-8"

            />

            <div class="flex justify-between lg:w-2/3">
                    <LinkButton
                        label="I've remembered!"
                        class="bg-gray-900 text-gray-500"
                        :link="route('login')"
                    />
                    <FormButton
                        label="Request Password Reset"
                    />
                </div>

        </FormLayout>
    </Layout>
</template>
