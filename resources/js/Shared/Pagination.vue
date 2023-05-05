<script setup>

import { Link } from '@inertiajs/vue3';

import ArrowNext from '@/Shared/SVG/ArrowNext.vue';
import ArrowPrevious from '@/Shared/SVG/ArrowPrevious.vue';
import IconButton from './IconButton.vue';

    defineProps({
        paginator: {
            type: Object,
            required : true
        }
    });

</script>


<template>
    <div v-if="paginator.links.length > 3">
        <div class="lg:flex place-content-center hidden">
            <template v-for="(plink, p) in paginator.links" :key="p">
                <div v-if="plink.url === null"
                    class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border rounded bg-gray-800 border-gray-600"
                    v-html="plink.label" />
                <Link v-else
                    class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded border-gray-600 hover:bg-blue-500 focus:blue-500 focus:text-indigo-500"
                    :class="{ 'bg-gray-400 text-white': plink.active }"
                    :href="plink.url"
                    v-html="plink.label" />
            </template>
        </div>

        <!--Mobile -->
        <div class="lg:hidden flex justify-evenly">
            <div v-for="(link, index) in [{id:0, href:paginator.prev_page_url},{id:1,href:paginator.next_page_url}]">
                <Component
                    :is="link.href ? Link : 'span'"
                    :href="link.href ">
                    <IconButton tooltip="Previous Page" :disable="!link.href">
                        <Component
                            :is="link.id === 0? ArrowPrevious : ArrowNext"
                            width="30"
                            height="30"
                            :class="{
                                'fill-white' : link.href,
                                'fill-gray-900' : !link.href
                            }"
                            />
                    </IconButton>
                </Component>
            </div>
        </div>
    </div>
</template>
