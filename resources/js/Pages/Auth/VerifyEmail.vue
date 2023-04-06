<script setup>

    import { provide } from 'vue'
    import { Link,useForm } from '@inertiajs/vue3'

    import Layout from '@/Shared/Layout.vue'
    import FormLayout from '@/Shared/FormLayout.vue'
    import FormInput from '@/Shared/FormInput.vue'
    import FormButton from '@/Shared/FormButton.vue'
    import WarningTriangle from '@/Shared/SVG/WarningTriangle.vue'


    const form = useForm({
        email: null
    });

    provide('form', form);


</script>


<template>
    <Layout title="Verify">


        <div class="w-full grid place-items-center">
            <div class="mb-10">
                <div class="flex justify-center items-center mb-10 bg-gray-800 rounded p-5">
                    <WarningTriangle class="fill-red-600 mr-5" height="30" width="30" />
                    <p class="text-3xl text-center">Your account is not yet verified.</p>

                </div>
                <div class="text-center">
                    Please check your email for the verification link
                </div>
            </div>
        <FormLayout method="post" :routeName="route('verification.resend')" class="lg:flex lg:justify-between lg:items-baseline text-gray-500 text-center" :box="false">
            <div class="text-xl lg:text-2xl mb-2 lg:mb-0">
                No Email? Enter your email to resend
            </div>

            <FormInput
                id="email"
                placeholder="Email"
                class="lg:w-1/3"

            />

            <FormButton
                label="Resend"
            />

        </FormLayout>
    </div>
    </Layout>
</template>
