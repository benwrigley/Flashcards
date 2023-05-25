<script setup>

import { provide } from 'vue'
import { useForm } from '@inertiajs/vue3'

import Layout from '@/Shared/Layout.vue'
import FormLayout from '@/Shared/Form/FormLayout.vue'
import FormInput from '@/Shared/Form/FormInput.vue'
import FormButton from '@/Shared/Form/FormButton.vue'
import LinkButton from '@/Shared/Form/LinkButton.vue'


const form = useForm({
    email: null,
    password: null,
});

provide('form', form);

</script>

<template>
    <Layout title="Login">
        <div class="w-full grid place-items-center">
        <FormLayout
            title="Welcome to Flashcards!"
            method="post"
            :routeName="route('login')">
                <div class="w-4/6">
                    <FormInput
                        id="email"
                        placeholder="Email"

                    />
                </div>
                <div class="w-4/6">
                    <FormInput
                        type="password"
                        id="password"
                        placeholder="Password"
                        />
                </div>
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
        <div class="mt-10 lg:text-xl text-sm fixed bottom-5">
            Not signed up yet? <LinkButton :link="route('register.create')" class="bg-gray-800" label="register here" />
        </div>
    </div>
    </Layout>
</template>