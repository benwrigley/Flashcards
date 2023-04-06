<script setup>

    import { provide } from 'vue'
    import { Link,useForm } from '@inertiajs/vue3'

    import Layout from '@/Shared/Layout.vue'
    import FormLayout from '@/Shared/FormLayout.vue'
    import FormInput from '@/Shared/FormInput.vue'
    import FormButton from '@/Shared/FormButton.vue'
    import LinkButton from '@/Shared/LinkButton.vue'


    const form = useForm({
        name: null,
        email: null,
        password: null,
    });

    provide('form', form);


</script>


<template>
    <Layout title="Register">
        <div class="w-full grid place-items-center">
        <FormLayout title="Register for Flashcards" method="post" :routeName="route('register.store')">
                <FormInput
                        id="name"
                        placeholder="Name"

                    />
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
                        label="Login"
                        class="bg-gray-900 text-gray-500"
                        :link="route('login')"
                    />
                    <FormButton
                        label="Register"
                    />
                </div>
        </FormLayout>
    </div>
    </Layout>
</template>
