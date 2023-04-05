<script setup>

import { provide } from 'vue'
import { Link,useForm } from '@inertiajs/vue3'

import Layout from '@/Shared/Layout.vue'
import FormLayout from '@/Shared/FormLayout.vue'
import FormInput from '@/Shared/FormInput.vue'
import FormButton from '@/Shared/FormButton.vue'
import LinkButton from '@/Shared/LinkButton.vue'




defineProps({ errors: Object })


const form = useForm({
    email: null,
    password: null,
});

provide('form', form);

</script>

<template>
    <Layout>
        <div class="w-full grid place-items-center">
        <FormLayout title="Welcome to Flashcards!" method="post" :routeName="route('login')">
                <FormInput
                    id="email"
                    placeholder="Email"

                />
                <FormInput
                    type="password"
                    id="password"
                    placeholder="Password"
                    />

                <div class="flex justify-around w-full">
                    <LinkButton
                        label="Forgot Password"
                        class="bg-gray-900 text-gray-500"
                        :link="route('password.request')"
                    />
                    <FormButton
                        label="Login"
                    />
                </div>
        </FormLayout>
        <div class="mt-10">
            Not registered yet? <LinkButton :link="route('register.create')" class="bg-gray-800" label="click here" />
        </div>
    </div>
    </Layout>
</template>