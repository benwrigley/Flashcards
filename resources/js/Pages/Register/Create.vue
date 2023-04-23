<script setup>

    import { provide } from 'vue'
    import { Link,useForm } from '@inertiajs/vue3'

    import Layout from '@/Shared/Layout.vue'
    import FormLayout from '@/Shared/Form/FormLayout.vue'
    import FormInput from '@/Shared/Form/FormInput.vue'
    import FormButton from '@/Shared/Form/FormButton.vue'
    import LinkButton from '@/Shared/Form/LinkButton.vue'


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
                    class="lg:w-2/3 w-3/4"

                    />
                <FormInput
                    id="email"
                    placeholder="Email"
                    class="lg:w-2/3 w-3/4"

                />
                <FormInput
                    type="password"
                    id="password"
                    placeholder="Password"
                    class="lg:w-2/3 w-3/4"
                    />

                <div class="flex justify-between lg:w-2/3 w-3/4">
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
