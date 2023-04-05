<script setup>

import ChevronDown from '@/Shared/SVG/ChevronDown.vue';
import MenuDown from '@/Shared/SVG/MenuDown.vue';


import { ref} from 'vue';
import { Link } from '@inertiajs/vue3';

const showPanel = ref(false);

</script>

<template>

    <div class="relative">

        <div>
            <!-- Large screen menu -->
            <div
                class="lg:flex items-center hidden lg:visible"
                @mouseover="showPanel = true"
            >
                {{ $page.props.auth.user.name }}
                <ChevronDown width="15" height="15" class="fill-white ml-3 " />
            </div>

            <!-- Mobile drop down -->
            <div
                class="visible lg:hidden"
                @click="showPanel= !showPanel">
                <MenuDown width="20" height="20" class="fill-white ml-3" />
            </div>

            <div
                id="dropdownHover"
                class="z-10 rounded-lg shadow-md mx-auto dark:bg-gray-700 absolute grid grid-cols-3 w-max right-0 text-center p-4 space-x-2 normal-case "
                v-show="showPanel"
                @mouseleave="showPanel = false"
            >
                <div class="col-span-2  border-r pr-2 pb-1">Total Flashcards</div>
                <div>245</div>
                <div class="col-span-2  border-r pr-2 pb-1">Completed Tests</div>
                <div>56</div>
                <div class="col-span-2  border-r pr-2">Avg Test Score</div>
                <div>45%</div>
                <div class="col-span-3 border-t mt-3">
                    <Link href="/logout" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"> Sign out</Link>
                </div>
            </div>
        </div>
    </div>


</template>