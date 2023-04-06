<script setup>

    import { provide } from 'vue'
    import { useForm } from '@inertiajs/vue3'

    import Layout from '@/Shared/Layout.vue'
    import FormLayout from '@/Shared/FormLayout.vue'
    import FormInput from '@/Shared/FormInput.vue'
    import FormButton from '@/Shared/FormButton.vue'
    import LinkButton from '@/Shared/LinkButton.vue'

    const props = defineProps({
        token : String
    });


    const form = useForm({
        email: null,
        password: null,
        password_confirmation: null,
        token : props.token
    });

    provide('form', form);


</script>


<template>
    <Layout title="Reset Password">
        <FormLayout title="Choose a new password" method="post" :routeName="route('password.update')">

            <FormInput
                id="email"
                placeholder="Enter Email Address"
                class="lg:w-2/3 w-3/4"

            />

            <FormInput
                type="password"
                id="password"
                placeholder="New Password"
                class="lg:w-2/3 w-3/4"

            />

            <FormInput
                type="password"
                id="password_confirmation"
                placeholder="Confirm Password"
                class="lg:w-2/3 w-3/4"

            />

            <div class="flex justify-between lg:w-2/3 w-full">
                    <LinkButton
                        label="I've remembered!"
                        class="bg-gray-900 text-gray-500"
                        :link="route('login')"
                    />
                    <FormButton
                        label="Reset Password"
                    />
                </div>

        </FormLayout>
    </Layout>
</template>
