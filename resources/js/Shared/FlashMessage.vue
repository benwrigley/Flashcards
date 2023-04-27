<script setup>
    import { usePage } from '@inertiajs/vue3';
    import { computed } from '@vue/reactivity';
    import { onMounted, ref, watch } from 'vue';

    const props = defineProps({

            error : {
                type : String,
                default: 'bg-red-800'
            },
            success : {
                type : String,
                default : 'bg-green-800'
            },
            notify : {
                type  :String,
                default : 'bg-blue-500'
            },
            class : {
                type : String,
                default : ''
            }
    });

    let show = ref(true);


    let flash = computed(() => {

        if (usePage().props.flash.error) {
            return {
                message : usePage().props.flash.error,
                class : props.class + ' ' + props.error
            }
        }
        else if ( usePage().props.flash.success){
            return {
                message : usePage().props.flash.success,
                class : props.class + ' ' + props.success
            }
        }
        else {
            return {
                message : usePage().props.flash.notify,
                class : props.class + ' ' + props.notify
            }
        }
    });

    watch(flash, () => {
        show.value = true;
        setTimeout(() => {
            show.value = false;
            usePage().props.flash = {};
        }, 4000);
    });

    onMounted(() => {
        setTimeout(() => {
                show.value = false;
                usePage().props.flash = {};
            }, 4000);
    });

</script>



<template>
    <div
        v-show="show"
        class="text-white fixed bottom-2 lg:bottom-10 right-2 lg:right-10 p-2 lg:p-5 rounded-2xl"
        :class="flash.class"
    >
        {{  flash.message }}

    </div>
</template>